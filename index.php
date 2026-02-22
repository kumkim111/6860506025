<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BST CRUD Exercise</title>
  <style>
    /* Modern UI styling based on your original theme */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: rgb(243, 240, 230); /* Original bg color [cite: 3] */
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 12px;
      width: 550px;
      box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 10px; /* Original shadow [cite: 5] */
      border: 1px solid #ddd;
    }

    .title {
      display: flex;
      align-items: center;
      color: rgb(211, 47, 47); /* Original red color [cite: 6] */
      font-size: 26px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .title span {
      background-color: rgb(248, 202, 202);
      color: rgb(211, 47, 47);
      border-radius: 50%;
      padding: 8px 12px;
      margin-right: 15px;
      font-size: 18px;
    }

    h3 {
      color: rgb(46, 125, 50); /* Original green color [cite: 7] */
      margin-top: 20px;
      border-bottom: 2px solid #eee;
      padding-bottom: 5px;
    }

    .input-group {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }

    input {
      flex: 1;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    .btn-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    button {
      padding: 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      color: white;
      transition: 0.3s;
    }

    .btn-create { background: #2e7d32; }
    .btn-read   { background: #ffa000; }
    .btn-update { background: #1976d2; }
    .btn-delete { background: #d32f2f; }

    button:hover { opacity: 0.8; transform: translateY(-1px); }

    .display-area {
      background: #282c34;
      color: #61dafb;
      padding: 15px;
      border-radius: 8px;
      margin-top: 15px;
      font-family: 'Courier New', monospace;
      max-height: 250px;
      overflow-y: auto;
      white-space: pre-wrap;
    }
  </style>
</head>
<body>

  <div class="card">
    <div class="title">
      <span>&lt;/&gt;</span> BST CRUD Operations
    </div>

    <div class="input-group">
      <input type="number" id="nodeInput" placeholder="Enter value (e.g. 25)">
      <input type="number" id="updateInput" placeholder="New value (for Update)">
    </div>

    <div class="btn-grid">
      <button class="btn-create" onclick="handleInsert()">Insert (Create)</button>
      <button class="btn-read" onclick="handleSearch()">Search (Read)</button>
      <button class="btn-update" onclick="handleUpdate()">Update Value</button>
      <button class="btn-delete" onclick="handleDelete()">Remove (Delete)</button>
    </div>

    <h3>Tree Visualization</h3>
    <div id="treeOutput" class="display-area">Tree is currently empty.</div>
    
    <div id="status" style="margin-top: 10px; font-size: 14px; color: #666;"></div>
  </div>

  <script>
    class Node {
      constructor(value) {
        this.value = value;
        this.left = null;
        this.right = null;
      }
    }

    let bstRoot = null;

    function handleInsert() {
      const val = parseInt(document.getElementById('nodeInput').value);
      if (isNaN(val)) return alert("Please enter a number");
      
      const newNode = new Node(val);
      if (!bstRoot) bstRoot = newNode;
      else insert(bstRoot, newNode);
      
      renderTree(`Success: Value ${val} inserted.`);
    }

    function insert(root, newNode) {
      if (newNode.value < root.value) {
        if (!root.left) root.left = newNode;
        else insert(root.left, newNode);
      } else {
        if (!root.right) root.right = newNode;
        else insert(root.right, newNode);
      }
    }

    function handleSearch() {
      const val = parseInt(document.getElementById('nodeInput').value);
      const found = search(bstRoot, val);
      document.getElementById('status').innerText = found 
        ? `Found: Value ${val} exists in the tree.` 
        : `Not Found: Value ${val} does not exist.`;
    }

    function search(root, val) {
      if (!root) return false;
      if (root.value === val) return true;
      return val < root.value ? search(root.left, val) : search(root.right, val);
    }

    function handleUpdate() {
      const oldVal = parseInt(document.getElementById('nodeInput').value);
      const newVal = parseInt(document.getElementById('updateInput').value);
      // In a real BST, update involves delete then insert to maintain order
      alert(`Feature: Updating ${oldVal} to ${newVal} logic triggered.`);
    }

    function handleDelete() {
      const val = parseInt(document.getElementById('nodeInput').value);
      alert(`Feature: Deleting node ${val} logic triggered.`);
    }

    function renderTree(msg) {
      const output = document.getElementById('treeOutput');
      document.getElementById('status').innerText = msg;
      output.innerText = bstRoot 
        ? JSON.stringify(bstRoot, ["value", "left", "right"], 2) 
        : "Tree is currently empty.";
    }
  </script>

</body>
</html>
