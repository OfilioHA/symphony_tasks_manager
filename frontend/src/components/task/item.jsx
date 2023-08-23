export function TaskItem({ title, description, tasks }) {
  return (
    <>
      <div className="task">
        <article>
          <h3>{title}</h3>
          <hr />
          <p>{description}</p>
        </article>
        <div className="sub-tasks ms-4">
          {tasks.map((item, index) => (
            <TaskItem {...item} key={index} />
          ))}
        </div>
      </div>
    </>
  );
}
