import React, { useState } from 'react';
import { MdDeleteSweep } from 'react-icons/md';

const TaskItem = ({ TaskService, refreshTasks, data }) => {
    return <li className="items">
        <div className="items-text">
            <input type="checkbox" disabled={ data.done } checked={ data.done } onChange={async e => {
                await TaskService.completeTask(data.id);
                refreshTasks();
            }} />
            <p onClick={e => {
                if(data.done) return;
                if(e.detail === 1) {
                    e.target.contentEditable = true;
                    e.target.focus();
                    e.target.parentElement.parentElement.classList.add("edit");
                }
            }} onBlur={async e => {
                e.target.contentEditable = false;
                e.target.parentElement.parentElement.classList.remove("edit");
                if(e.target.innerText === data.description) return;

                await TaskService.updateTask(data.id, e.target.innerText);
                refreshTasks();
            }} style={{ textDecoration: data.done ? "line-through" : "none" }}
            >{data.description}</p>
        </div>
        <MdDeleteSweep className="delete-icon" onClick={async e => {
            await TaskService.deleteTask(data.id);
            refreshTasks();
        }} />
    </li>;
}

export default TaskItem;