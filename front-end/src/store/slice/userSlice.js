import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import { ENDPOINT } from "../../constants";
export const fetchUsers = createAsyncThunk("users/fetchUsers", async () => {
  const response = await fetch(`${ENDPOINT}/users`);
  return response.json();
});
const userSlice = createSlice({
  name: "users",
  initialState: { users: [] },
  reducers: {},
  // extraReducers: (builder) => {},
});

export default userSlice;
