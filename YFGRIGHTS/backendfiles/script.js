// Add new row for file input
        function addRow() {
            const extraFiles = document.getElementById("extraFiles");

            const fileRow = document.createElement("div");
            fileRow.classList.add("file-row");

            fileRow.innerHTML = `
                <input type="file" name="files[]" required>
                <button type="button" class="remove-btn" onclick="removeRow(this)">✖</button>
            `;

            extraFiles.appendChild(fileRow);
        }

        // Remove file row
        function removeRow(button) {
            const row = button.parentNode;
            row.parentNode.removeChild(row);
        }

        // Validate form
        function validateForm() {
            const files = document.getElementsByName("files[]");

            for (let i = 0; i < files.length; i++) {

                if (files[i].value === "") {
                    alert("Please choose a file for each title.");
                    return false;
                }
            }

            return true;
        }