import React from "react";
import { useSelector } from "react-redux";
import Post from "./Post";

const Posts = () => {
  const { posts } = useSelector((state) => state.posts);

  return (
    <div className="d-flex">
      {typeof posts === "object"
        ? posts.map((post) => <Post key={post.id} post={post} />)
        : posts}
    </div>
  );
};

export default Posts;
