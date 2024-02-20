import React, { useLayoutEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

const Dashboard = () => {
  const [user, setUser] = useState({});

  const navigate = useNavigate();
  useLayoutEffect(() => {
    try {
      const loginUser = JSON.parse(sessionStorage.getItem("user"));
      if (!loginUser) {
        navigate("/admin");
      } else {
        setUser(loginUser);
      }
    } catch (error) {
      navigate("/admin");
      console.error("Error parsing user data:", error);
    }
  }, [navigate]);

  return (
    <div>
      <h1>{user?.nom}</h1>
    </div>
  );
};

export default Dashboard;
