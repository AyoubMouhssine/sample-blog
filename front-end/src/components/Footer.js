import React from "react";

const Footer = () => {
  return (
    <footer className="bg-dark text-primary py-4 p-relative bottom-0">
      <div className="container text-center">
        <p>
          &copy; {new Date().getFullYear()} Sample Blog. All rights reserved.
        </p>
        <p>Designed and developed by Ayoub Mouhssine</p>
      </div>
    </footer>
  );
};

export default Footer;
