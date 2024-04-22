import { BrowserRouter, Route, Routes } from "react-router-dom";
import Login from "./views/Login";

export default function Router() {
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Login />} />
            </Routes>
        </BrowserRouter>
    )
}