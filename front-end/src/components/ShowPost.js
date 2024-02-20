import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import SyntaxH from "../SyntaxH";
import { ENDPOINT } from "../constants";
const ShowPost = () => {
  const { id } = useParams();
  const [post, setPost] = useState({});

  async function getUserById(id) {
    const response = await fetch(`${ENDPOINT}/posts/show?id=${id}`);
    const data = await response.json();

    setPost(data);
  }
  useEffect(() => {
    getUserById(+id);
  }, [id]);

  console.log(post);
  return (
    <div>
      <h1 className="text-center">{post.title}</h1>
      <span className="text-center d-block">{post.created_at}</span>
      <pre>
        <p>{post.content}</p>
      </pre>
      <SyntaxH
        code={post.code}
        language={post.language}
        style={{ height: "fit-content" }}
      />
    </div>
  );
};

export default ShowPost;
