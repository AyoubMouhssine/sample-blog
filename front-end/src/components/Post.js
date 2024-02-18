import React from "react";

const Post = ({ post }) => {
  return (
    <div className="card" style={{ width: "18rem" }}>
      <div className="card-body">
        <h5 className="card-title">{post.title}</h5>
        <h6 className="card-subtitle mb-2 text-muted">Card subtitle</h6>
        <p className="card-text">{post.content.slice(0, 10)}...</p>
        <a href="#" className="card-link">
          Read More
        </a>
        <a href="#" className="card-link">
          Another link
        </a>
      </div>
    </div>
  );
};

export default Post;
