import React from "react";
import {
  Navbar,
  Nav,
  Container,
  Form,
  FormControl,
  Button,
} from "react-bootstrap";
import { useDispatch } from "react-redux";
import { filterPosts } from "../store/slice/postSlice";
const Header = () => {
  const dispatch = useDispatch();
  const handleSubmit = (e) => {
    e.preventDefault();
    const search = e.target["search"].value;

    dispatch(filterPosts(search));
  };
  return (
    <Navbar bg="light" expand="lg">
      <Container>
        <Navbar.Brand href="/">Sample Blog</Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="mr-auto">
            <Nav.Link href="/">Home</Nav.Link>
            <Nav.Link href="/posts">Posts</Nav.Link>
            <Nav.Link href="/about">About</Nav.Link>
          </Nav>
          <Form
            onSubmit={handleSubmit}
            inline="true"
            className="d-flex justify-content-center align-items-center flex-grow-1"
          >
            <FormControl
              type="text"
              placeholder="Search"
              name="search"
              className="mr-sm-2"
            />
            <Button variant="outline-primary" type="submit">
              Search
            </Button>
          </Form>
          <Nav>
            <Nav.Link href="/login">Login</Nav.Link>
            <Nav.Link href="/signup">Sign Up</Nav.Link>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
};

export default Header;
