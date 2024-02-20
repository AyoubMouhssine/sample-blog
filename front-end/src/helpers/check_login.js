import { ENDPOINT } from "../constants";

export async function check_login(formData) {
  const response = await fetch(`${ENDPOINT}/users/show`, {
    method: "post",
    body: formData,
  });

  return response.json();
}
