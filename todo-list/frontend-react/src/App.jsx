import React, { useState } from 'react';
import TaskView from "./view/TaskView";
import IndexView from "./view/IndexView";

function App() {

  const [isLogged, setIsLogged] = useState(false);


  return <>
    <div className="container">
      <h1>Todo List</h1>

      {isLogged ? <TaskView /> : <IndexView />}

    </div>
  </>;
}

export default App;
