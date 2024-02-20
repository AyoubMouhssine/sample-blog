import React from "react";
import { Link } from "react-router-dom";

const Post = ({ post }) => {
  return (
    <div className="card" style={{ width: "18rem" }}>
      <div className="card-body">
        <h5 className="card-title">{post.title}</h5>
        <p className="card-text">{post.content.slice(0, 10)}...</p>
        <Link
          className="btn btn-outline-dark card-link"
          to={`/posts/${post.id}`}
        >
          Read More
        </Link>
      </div>
    </div>
  );
};

export default Post;
