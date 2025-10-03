import express from "express";
import path from "path";
import { fileURLToPath } from "url";

const app = express();
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Serve hasil build Vite (frontend)
app.use(express.static(path.join(__dirname, "dist")));

// Kalau ada route lain (API, dll.)
app.get("/api/hello", (req, res) => {
  res.json({ message: "Hello from backend!" });
});

// Fallback ke index.html (supaya SPA jalan)
app.get("*", (req, res) => {
  res.sendFile(path.join(__dirname, "dist", "index.html"));
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
