import React, { useEffect } from "react";

const App = () => {
    useEffect(() => {
        fetch("https://kanfadon.ru/api/words", {
            method: "POST",
            body: JSON.stringify({}),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        }).then((result) => result.json())
        .then((data) => console.log(data));
    }, []);

    return (
        <div>123</div>
    );
}

export default App;