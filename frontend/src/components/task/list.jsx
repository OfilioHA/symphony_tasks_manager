import { useEffect, useState } from "react";
import axios from 'axios';
import { TaskItem } from "./item";

export function TaskList(){

    const [taskList, setTaskList] = useState([]);

    useEffect(()=> {
        (async function(){
            const response = await axios.get('http://localhost:8000/task');
            setTaskList(response.data);
        })()
    }, []);

    return (
        <>
            {taskList.map((item, index)=>(
                <TaskItem {...item} key={index} />
            ))}
        </>
    );
}