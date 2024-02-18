Sure! Below is a README.md file documentation for your API:

---

# Sample Blog API Documentation

This document provides details about the endpoints and usage of the Sample Blog API.

## Base URL

The base URL for all API endpoints is:

```
https://sample-blog.com/api
```

## Endpoints

### 1. Get All Posts

- **URL**: `/posts`
- **Method**: `GET`
- **Description**: Retrieve a list of all posts.
- **Response**:

  ```json
  [
    {
      "id": 1,
      "title": "Sample Post 1",
      "content": "This is the content of Sample Post 1."
    },
    {
      "id": 2,
      "title": "Sample Post 2",
      "content": "This is the content of Sample Post 2."
    }
  ]
  ```

### 2. Get Post by ID

- **URL**: `/posts/show`
- **Method**: `GET`
- **Parameters**:
  - `id` (integer): ID of the post to retrieve.
- **Response**:

  ```json
  {
    "id": 1,
    "title": "Sample Post 1",
    "content": "This is the content of Sample Post 1."
  }
  ```

### 3. Create Post

- **URL**: `/posts/create`
- **Method**: `POST`
- **Parameters** (in request body):
  - `title` (string): Title of the new post.
  - `content` (string): Content of the new post.
- **Response**:
  - Success: `{"message": "Post created successfully"}`
  - Failure: `{"error": "Failed to create post"}`

### 4. Update Post

- **URL**: `/posts/update`
- **Method**: `PUT`
- **Request Body** (as JSON):
  ```json
  {
    "id": 1,
    "title": "Updated Title",
    "content": "Updated Content"
  }
  ```
- **Response**:
  - Success: `{"message": "Post updated successfully"}`
  - Failure: `{"error": "Failed to update post"}`

### 5. Delete Post

- **URL**: `/posts/delete`
- **Method**: `DELETE`
- **Parameters** (in request body or query string):
  - `id` (integer): ID of the post to delete.
- **Response**:
  - Success: `{"message": "Post deleted successfully"}`
  - Failure: `{"error": "Failed to delete post"}`

## Status Codes

The API may return the following status codes:

- `200 OK`: The request was successful.
- `400 Bad Request`: The request was invalid or missing required parameters.
- `404 Not Found`: The requested resource was not found.
- `405 Method Not Allowed`: The HTTP method used is not supported for the requested endpoint.
- `500 Internal Server Error`: An unexpected error occurred on the server.

