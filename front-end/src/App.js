import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { fetchPosts } from "./store/slice/postSlice";
import Posts from "./components/Posts";
import { Route, Routes } from "react-router-dom";
import Admin from "./components/Admin";
import Dashboard from "./components/Dashboard";
import Login from "./components/Login";
import ShowPost from "./components/ShowPost";
import Header from "./components/Header";
import "../node_modules/bootstrap/dist/css/bootstrap.min.css";
const App = () => {
  const { posts, isLoading, isError, error } = useSelector(
    (state) => state.posts
  );

  const dispatch = useDispatch();
  useEffect(() => {
    dispatch(fetchPosts());
  }, [dispatch]);

  if (isLoading) return <h1>loading</h1>;

  if (isError) return <h1>{error}</h1>;

  return (
    <div>
      <Header />
      <Routes>
        <Route path="/">
          <Route index element={<Posts />} />
          <Route path="post/:id" element={<ShowPost />} />
        </Route>
        <Route path="/admin" element={<Admin />}>
          <Route index element={<Login />} />
          <Route path="dashboard" element={<Dashboard />} />
        </Route>
      </Routes>
    </div>
  );
};

export default App;
