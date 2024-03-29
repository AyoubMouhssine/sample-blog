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

  return (
    <div>
      <h1 className="text-center">{post.title}</h1>
      <span className=" text-center d-block text-primary">
        Author : {post.nom} {post.prenom}
      </span>
      <pre>
        <p>{post.content}</p>
      </pre>
      {post.code && (
        <SyntaxH
          code={post.code}
          language={post.language}
          style={{ height: "fit-content" }}
        />
      )}
    </div>
  );
};

export default ShowPost;
