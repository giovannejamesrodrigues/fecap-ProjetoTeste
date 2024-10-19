import React, { useState, useEffect } from 'react';
import * as UserService from "../services/User";

const RegisterView = (params) => {

    const setView = params.setView;

    const [erro, setErro] = useState("");

    const [loginInput, setLoginInput] = useState("");
    const [passwordInput, setPasswordInput] = useState("");
    const [password2Input, setPassword2Input] = useState("");
    const [isPasswordSecure, setIsPasswordSecure] = useState(false);
    const [isPasswordsSame, setIsPasswordsSame] = useState(false);

    useEffect(() => {
        validatePasswordSecurity(passwordInput);
        checkPasswordsMatch(passwordInput, password2Input);
    }, [passwordInput, password2Input]);

    const validatePasswordSecurity = (password) => {
        // Exemplo de validação de segurança de senha
        const isSecure = password.length >= 3;
        setIsPasswordSecure(isSecure);
    };

    const checkPasswordsMatch = (password, confirmPassword) => {
        const isSame = password === confirmPassword;
        setIsPasswordsSame(isSame);
    };

    return <>
        <h2>Cadastro</h2>
        <form onSubmit={async e => {
            e.preventDefault();
            try {
                await UserService.register(loginInput, passwordInput)
                setErro("");
                setView("tasks");
            } catch (error) {
                setErro(error.message);
            }
        }}>
            <div className="inputField">
                <input type="text" placeholder="Login" value={loginInput} onChange={e => setLoginInput(e.target.value)} />
            </div>
            <div className="inputField" style={{ marginTop: "1em" }}>
                <input type="password" placeholder="Senha" value={passwordInput} onChange={e => setPasswordInput(e.target.value)} />
            </div>
            {!isPasswordSecure && <p className="input-hint">A senha deve conter pelo menos 3 caracteres</p>}
            <div className="inputField" style={{ marginTop: "1em" }}>
                <input type="password" placeholder="Confirmar a Senha" value={password2Input} onChange={e => setPassword2Input(e.target.value)} />
            </div>
            {isPasswordSecure && !isPasswordsSame && <p className="input-hint">As senhas não coincidem.</p>}
            <div style={{ margin: "1em", display: "flex", alignItems: "center", justifyContent: "center", gap: "1em" }}>
                <a className="link" onClick={e => setView("login")}>Já tenho uma conta</a>
                <button className="submit-button" type="submit" disabled={!(isPasswordSecure && isPasswordsSame)}>Cadastrar</button>
            </div>
        </form>
    </>;
}

export default RegisterView;