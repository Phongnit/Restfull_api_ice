<!DOCTYPE html>
<html>

<head>
    <title>CRUD App</title>
    <style>
        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Item List</h1>

    <form id="itemForm">
        <input id="nameInput" type="text" placeholder="Name" required>
        <textarea id="descriptionInput" placeholder="Description"></textarea>
        <button type="submit">Add Item</button>
    </form>

    <ul id="itemList"></ul>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        const itemForm = document.getElementById('itemForm');
        const nameInput = document.getElementById('nameInput');
        const descriptionInput = document.getElementById('descriptionInput');
        const itemList = document.getElementById('itemList');

        function fetchItems() {
            axios.get('/api/items')
                .then(response => {
                    itemList.innerHTML = '';
                    response.data.forEach(item => {
                        const li = document.createElement('li');
                        li.textContent = `${item.name} - ${item.description}`;
                        itemList.appendChild(li);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function addItem() {
            const name = nameInput.value;
            const description = descriptionInput.value;

            axios.post('/api/items', {
                    name,
                    description
                })
                .then(response => {
                    fetchItems();
                    nameInput.value = '';
                    descriptionInput.value = '';
                })
                .catch(error => {
                    console.error(error);
                });
        }

        itemForm.addEventListener('submit', event => {
            event.preventDefault();
            addItem();
        });

        fetchItems();
    </script>
</body>

</html>
