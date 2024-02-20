import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import { ENDPOINT } from "../../constants";

export const fetchPosts = createAsyncThunk("posts/fetchPosts", async () => {
  const response = await fetch(`${ENDPOINT}/posts`);
  return response.json();
});

const postSlice = createSlice({
  name: "posts",
  initialState: {
    posts: [],
    filteredPosts: [],
    isLoading: false,
    isError: false,
    error: "",
  },
  reducers: {
    filterPosts(state, { payload }) {
      state.filteredPosts = state.posts.filter((post) =>
        post.title.toLowerCase().includes(payload.toLowerCase())
      );
    },
  },
  extraReducers: (builder) => {
    builder
      .addCase(fetchPosts.pending, (state, action) => {
        state.isLoading = true;
      })
      .addCase(fetchPosts.fulfilled, (state, action) => {
        state.posts = action.payload;
        state.isLoading = false;
      })
      .addCase(fetchPosts.rejected, (state, action) => {
        state.isLoading = false;
        state.isError = true;
        state.error = "error fetching data from the endpoint";
      });
  },
});
export const { filterPosts } = postSlice.actions;
export default postSlice;
