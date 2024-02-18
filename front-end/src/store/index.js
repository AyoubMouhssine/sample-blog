import { configureStore } from "@reduxjs/toolkit";
import postSlice from "./slice/postSlice";

const store = configureStore({
  reducer: {
    [postSlice.name]: postSlice.reducer,
  },
});

export default store;
