import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";

const ENDPOINT = "http://sample-blog/api";

export const fetchPosts = createAsyncThunk("posts/fetchPosts", async () => {
  const response = await fetch(`${ENDPOINT}/posts`);
  return response.json();
});

const postSlice = createSlice({
  name: "posts",
  initialState: {
    posts: [],
    isLoading: false,
    isError: false,
    error: "",
  },
  reducers: {},
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
        state.isError = true;
        state.error = "error fetching data for the endpoint";
      });
  },
});

export default postSlice;
