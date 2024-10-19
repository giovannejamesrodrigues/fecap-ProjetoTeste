import React, { useState } from 'react';

const TaskInput = ({ TaskService, refreshTasks }) => {

    const [taskNameInput, setTaskNameInput] = useState('');

    const handleAddTask = async e => {
        e.preventDefault();

        const taskName = taskNameInput.trim();
        if (!taskName) return;
        setTaskNameInput('');

        await TaskService.addTask(taskName);
        refreshTasks();
    }

    return <form className="inputField" onSubmit={handleAddTask}>
        <input type="text" placeholder="Nova tarefa" value={taskNameInput} onChange={e => setTaskNameInput(e.target.value)} />
        <button type="submit">+</button>
    </form>;
}

export default TaskInput;