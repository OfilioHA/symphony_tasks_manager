import "./App.css";
import { useState } from "react";
import { Container, Row, Col } from "react-bootstrap";
import { TaskList } from "./components/task/list";

function App() {
  const [count, setCount] = useState(0);

  return (
    <>
      <h1>Hello Gatito</h1>
      <p>{count}</p>
      <button onClick={() => setCount((old) => old + 1)}>Culo</button>
      <Container>
        <Row className="justify-content-center">
          <Col md={12}>
            <TaskList />
          </Col>
        </Row>
      </Container>
    </>
  );
}

export default App;
