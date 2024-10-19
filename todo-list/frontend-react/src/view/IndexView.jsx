import React, { useState } from 'react';
import LoginView from "./LoginView";
import RegisterView from "./RegisterView";
import TaskView from './TaskView';

const IndexView = () => {

    const [view, setView] = useState("login");

    return <>
        {{
            login:      <LoginView      setView={setView} />,
            register:   <RegisterView   setView={setView} />,
            tasks:      <TaskView       setView={setView} />,
        }[view]}
    </>;
}

export default IndexView;