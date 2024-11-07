// Select draggable input buttons and the drop area
const draggableCaps = document.querySelectorAll('.draggable-cap');
const dropArea = document.getElementById('drop-area');

// Create a hidden input to store the dropped values as JSON
const hiddenInput = document.createElement('input');
hiddenInput.type = 'hidden';
hiddenInput.name = 'vrewp_dropped_values'; // Name for PHP to use in form submission
hiddenInput.id = 'vrewp_dropped_values';

// Add the hidden input to the same form or parent element as the drop area
dropArea.appendChild(hiddenInput); // or append it to a parent form element

// Add event listeners for each draggable input button
draggableCaps.forEach(input => {
    input.addEventListener('dragstart', (event) => {
        // Check if the button is already in the drop area
        if (dropArea.contains(event.target)) {
            // Prevent dragging if already in the drop area
            event.preventDefault();
            return;
        }

        // Store the dragged element's value (text) and class
        event.dataTransfer.setData('text/plain', event.target.value);
        event.dataTransfer.setData('class', event.target.className);
        event.dataTransfer.effectAllowed = 'move';
        input.classList.add('dragging');
    });

    input.addEventListener('dragend', () => {
        input.classList.remove('dragging');
    });
});

// Add event listeners for the drop area
dropArea.addEventListener('dragover', (event) => {
    event.preventDefault();
    dropArea.classList.add('drag-over');
    event.dataTransfer.dropEffect = 'move';
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('drag-over');
});

dropArea.addEventListener('drop', (event) => {
    event.preventDefault();
    dropArea.classList.remove('drag-over');
    
    // Retrieve the dragged item's value and class
    const draggedValue = event.dataTransfer.getData('text/plain');
    const draggedClass = event.dataTransfer.getData('class');
    
    // Check if the element is already in the drop area (based on value)
    if ([...dropArea.getElementsByTagName('input')].some(input => input.value === draggedValue)) {
        return; // Do not add it if already exists
    }

    // Create a new input button with the same properties
    const newInput = document.createElement('input');
    newInput.type = 'button';
    newInput.value = draggedValue;
    newInput.className = draggedClass; // Apply the same class to the new button

    // Append the new button to the drop area
    dropArea.appendChild(newInput);

    // Update the hidden input field with the current dropped items' values
    updateDroppedValues();
});



// Function to update the hidden input with all dropped values in JSON format
function updateDroppedValues() {
    // Gather all dropped button values as an array
    const droppedValues = [...dropArea.getElementsByTagName('input')].map(input => input.value);

    // Ensure the droppedValues array is correctly formatted
    console.log(droppedValues); // Check the values in the console

    // Update the hidden input value with a properly serialized JSON string
    hiddenInput.value = JSON.stringify(droppedValues); // Convert the array to JSON
}
