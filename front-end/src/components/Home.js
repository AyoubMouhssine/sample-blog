import React from "react";
import { Link } from "react-router-dom";

const Home = () => {
  return (
    <div className="container mt-5">
      <div className="row">
        <div className="col-md-8 offset-md-2">
          <h2>Welcome to Sample Blog</h2>
          <p>
            Welcome to Sample Blog, your go-to destination for thought-provoking
            articles, insightful analysis, and engaging discussions. Whether
            you're a seasoned enthusiast or just starting your journey, we've
            got something for everyone.
          </p>
          <p>
            At Sample Blog, we cover a wide range of topics, including
            technology, science, literature, travel, lifestyle, and much more.
            Our dedicated team of writers and contributors work tirelessly to
            bring you the latest news, trends, and stories from around the
            globe.
          </p>
          <p>
            Explore our curated collection of articles, spanning from in-depth
            guides and tutorials to thought-provoking opinion pieces and
            inspiring personal narratives. Dive into the world of knowledge,
            creativity, and inspiration that awaits you.
          </p>
          <p>
            Join our vibrant community of readers and writers, where you can
            share your thoughts, ask questions, and connect with like-minded
            individuals. Whether you're here to learn, share, or simply explore,
            Sample Blog is your ultimate destination for all things informative
            and entertaining.
          </p>
          <p>
            Ready to embark on your journey? Click the button below to start
            exploring our diverse range of articles and discover something new
            today!
          </p>
          <p>
            <Link href="/posts" className="btn btn-primary">
              View Posts
            </Link>
          </p>
        </div>
      </div>
    </div>
  );
};

export default Home;
