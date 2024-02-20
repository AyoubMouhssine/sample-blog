import React, { useState } from "react";
import SyntaxHighlighter from "react-syntax-highlighter";
import { atomOneDark } from "react-syntax-highlighter/dist/esm/styles/hljs";

const SyntaxH = ({ code, language, style }) => {
  const [copy, setCopy] = useState(false);

  const handleClick = () => {
    navigator.clipboard.writeText(code);
    setCopy(true);
    setTimeout(() => {
      setCopy(false);
    }, 3000);
  };

  return (
    code && (
      <div style={style}>
        <div
          className="bg-dark"
          style={{
            position: "relative",
            height: "40px",
          }}
        >
          <button
            onClick={handleClick}
            className="btn btn-outline-dark text-light"
            style={{
              position: "absolute",
              right: "0",
              display: "flex",
              alignItems: "center",
              justifyContent: "center",
              gap: "2px",
            }}
          >
            {copy ? (
              <>
                <ion-icon name="checkmark-sharp"></ion-icon>
                <span>copied</span>
              </>
            ) : (
              <>
                <ion-icon name="clipboard-outline"></ion-icon>
                <span> copy</span>
              </>
            )}
          </button>
        </div>
        <SyntaxHighlighter language={language} style={atomOneDark}>
          {code}
        </SyntaxHighlighter>
      </div>
    )
  );
};

export default SyntaxH;
