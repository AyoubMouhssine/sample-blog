import { configureStore } from "@reduxjs/toolkit";
import postSlice from "./slice/postSlice";
import userSlice from "./slice/userSlice";


const store = configureStore({
  reducer: {
    [postSlice.name]: postSlice.reducer,
    [userSlice.name]: userSlice.reducer,
  },
});

export default store;
