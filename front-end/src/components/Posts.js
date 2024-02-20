import React from "react";
import { useSelector } from "react-redux";
import Post from "./Post";

const Posts = () => {
  const { posts, filteredPosts } = useSelector((state) => state.posts);

  const list = !filteredPosts.length ? posts : filteredPosts;
  return (
    <div className="d-flex gap-3">
      {typeof list === "object"
        ? list.map((post) => <Post key={post.id} post={post} />)
        : list}
    </div>
  );
};

export default Posts;
