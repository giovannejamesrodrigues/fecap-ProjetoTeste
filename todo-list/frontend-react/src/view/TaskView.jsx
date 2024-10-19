import React, { useState, useEffect } from 'react';
import TaskInput from "../components/TaskInput";
import TaskItem from "../components/TaskItem";

import * as TaskService from "../services/Task";

const TaskView = () => {

    const [ tasks, setTasks ] = useState([]);

    const refreshTasks = async function() {
        setTasks(await TaskService.listTasks());
    }

    useEffect(() => {
        refreshTasks();
    }, []);

    const addTask = taskName => {
        TaskService.addTask(taskName);
        refreshTasks();
    }

    return <>
        <TaskInput TaskService={TaskService} refreshTasks={refreshTasks} />
        <div className="toDoList">
            <span>Pendentes</span>
            {tasks.length === 0 && <p className="notify" style={{marginTop: "1rem"}}>Nenhuma tarefa pendente!</p>}
            <ul className="list-items">
                {tasks.map((task, key) => <TaskItem TaskService={TaskService} refreshTasks={refreshTasks} data={task} key={key}/>)}
            </ul>
        </div>
    </>;
}

export default TaskView;