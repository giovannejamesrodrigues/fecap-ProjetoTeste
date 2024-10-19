import React, { useState } from 'react';
import * as UserService from "../services/User";

const LoginView = (params) => {

    const setView = params.setView;

    const [erro, setErro] = useState("");

    const [loginInput, setLoginInput] = useState("");
    const [passwordInput, setPasswordInput] = useState("");

    return <>
        <h2>Login</h2>
        <form onSubmit={async e => {
            e.preventDefault();
            try {
                await UserService.login(loginInput, passwordInput)
                setErro("");
                setView("tasks");
            } catch (error) {
                setErro(error.message);
            }
        }}>
            {erro && <div className="error"><b>Erro:</b> {erro}</div>}
            <div className="inputField">
                <input type="text" placeholder="Login" value={loginInput} onChange={e => setLoginInput(e.target.value)} />
            </div>
            <div className="inputField" style={{ marginTop: "1em" }}>
                <input type="password" placeholder="Senha" value={passwordInput} onChange={e => setPasswordInput(e.target.value)} />
            </div>
            <div style={{ margin: "1em", display: "flex", alignItems: "center", justifyContent: "center", gap: "1em" }}>
                <a className="link" onClick={e => setView("register")}>Criar uma conta</a>
                <button className="submit-button" type="submit">Entrar</button>
            </div>
        </form>
    </>;
}

export default LoginView;