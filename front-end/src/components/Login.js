import React, { useState } from "react";
import {
  Button,
  Card,
  CardBody,
  CardHeader,
  Col,
  Container,
  FormCheck,
  FormControl,
  FormGroup,
  FormLabel,
  Row,
  Form,
} from "react-bootstrap";
import { Link, useNavigate } from "react-router-dom";
import { check_login } from "../helpers/check_login";

const Login = () => {
  const [rememberMe, setRememberMe] = useState(false);
  const [error, setError] = useState({
    email: "",
    password: "",
  });

  const navigate = useNavigate();

  const handleSubmit = async (event) => {
    event.preventDefault();

    const formdata = new FormData(event.target);

    const email = formdata.get("email");
    const password = formdata.get("password");

    setError((prevState) => ({
      ...prevState,
      email: email ? "" : "Email is required",
      password: password ? "" : "Password is required",
    }));

    if (email && password) {
      try {
        const response = await check_login(formdata);
        if (response === "email") {
          setError((prev) => {
            return {
              ...prev,
              email: "aucun utilisateur trouvé avec cet e-mail",
            };
          });
          setError((prev) => {
            return {
              ...prev,
              email: "aucun utilisateur trouvé avec cet e-mail",
            };
          });
        } else if (response === "password") {
          setError((prev) => {
            return {
              ...prev,
              password: "mot de passe incorrect",
            };
          });
        } else {
          sessionStorage.setItem("user", JSON.stringify(response));
          navigate("/dashboard");
        }
      } catch (error) {
        console.error("Error occurred:", error);
      }
    }
  };

  return (
    <Container className="w-50 my-5">
      <Card>
        <CardHeader className="text-center">
          <h2>Login</h2>
        </CardHeader>
        <CardBody>
          <Form onSubmit={handleSubmit}>
            <FormGroup className="mb-3">
              <FormLabel htmlFor="email">Email</FormLabel>
              <FormControl
                type="email"
                id="email"
                placeholder="Enter email"
                name="email"
              />
              {error.email && (
                <span className="text-danger">{error.email}</span>
              )}
            </FormGroup>
            <FormGroup className="mb-3">
              <FormLabel htmlFor="password">Password</FormLabel>
              <FormControl
                type="password"
                id="password"
                name="password"
                placeholder="Enter password"
              />
              {error.password && (
                <span className="text-danger">{error.password}</span>
              )}
            </FormGroup>
            <FormCheck className="mb-3">
              <input
                type="checkbox"
                className="form-check-input"
                id="remember-me"
                checked={rememberMe}
                onChange={(e) => setRememberMe(e.target.checked)}
              />
              <FormLabel className="form-check-label" htmlFor="remember-me">
                Remember Me
              </FormLabel>
            </FormCheck>
            <Button variant="primary" type="submit" block="true">
              Login
            </Button>
          </Form>
          <Row className="mt-3 text-end">
            <Col>
              <Link>Forgot Password?</Link>
            </Col>
          </Row>
        </CardBody>
      </Card>
    </Container>
  );
};

export default Login;
