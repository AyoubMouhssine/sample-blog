import React, { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { fetchPosts } from "./store/slice/postSlice";
import Posts from "./components/Posts";
import { Route, Routes } from "react-router-dom";
import Admin from "./components/Admin";
import Dashboard from "./components/Dashboard";
import Login from "./components/Login";
import ShowPost from "./components/ShowPost";
import Header from "./components/Header";
import "bootstrap/dist/css/bootstrap.min.css";
import Home from "./components/Home";
import Footer from "./components/Footer";
import About from "./components/About";
import "./app.css";
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
      <div className="container mt-2 py-3">
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/about" element={<About />} />
          <Route path="/posts" element={<Posts />} />
          <Route path="/posts/:id" element={<ShowPost />} />
          <Route path="/admin" element={<Admin />} />
          <Route path="/login" element={<Login />} />
          <Route path="/dashboard" element={<Dashboard />} />
        </Routes>
      </div>
      <Footer />
    </div>
  );
};

export default App;

/*
 * link table users with posts [each user can have multiple posts];
 * justify LoginHeader
 * create Dashboard page [for users with email, password]
 * create admin page [for admin only]
 */
