var logs = [];

// Function to add activity to the log
function addActivity() {
    var activityInput = document.getElementById("activityInput");
    var activity = activityInput.value;
    if (activity.trim() === '') {
        alert("Please enter a valid activity.");
        return;
    }

    var timestamp = new Date().toLocaleString();
    logs.push({ activity, timestamp });
    activityInput.value = '';

    renderLogs();
}

// Function to render logs on the page
function renderLogs() {
    var logContainer = document.getElementById("logContainer");
    logContainer.innerHTML = '';

    for (var i = 0; i < logs.length; i++) {
        var logRow = document.createElement("div");
        logRow.className = "logEntry";
        logRow.innerHTML = `
            <span>${logs[i].timestamp} - </span>
            <input type="text" value="${logs[i].activity}" id="log_${i}" readonly>
            <button onclick="editActivity(${i})">Edit</button>
            <button onclick="saveActivity(${i})" style="display:none;">Save</button>
        `;
        logContainer.appendChild(logRow);
    }
}

// Function to edit activity
function editActivity(index) {
    var logInput = document.getElementById(`log_${index}`);
    var saveButton = logInput.nextElementSibling.nextElementSibling;
    var editButton = logInput.nextElementSibling;
    logInput.removeAttribute('readonly');
    saveButton.style.display = "inline";
    editButton.style.display = "none";
}

// Function to save activity
function saveActivity(index) {
    var logInput = document.getElementById(`log_${index}`);
    var saveButton = logInput.nextElementSibling;
    var editButton = logInput.nextElementSibling.previousElementSibling;
    logInput.setAttribute('readonly', true);
    saveButton.style.display = "none";
    editButton.style.display = "inline";

    logs[index].activity = logInput.value;
}

// Initial render
renderLogs();