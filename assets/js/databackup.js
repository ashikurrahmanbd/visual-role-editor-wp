// Select draggable input buttons and the drop area
const draggableCaps = document.querySelectorAll('.draggable-cap');
const dropArea = document.getElementById('drop-area');
const vrewpDraggableCaps = document.getElementById('vrewp-draggable-caps'); // Original container

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
    newInput.setAttribute('draggable', 'true'); // Make it draggable again
    
    // Enable dragging for this newly added input
    newInput.addEventListener('dragstart', (event) => {
        event.dataTransfer.setData('text/plain', event.target.value);
        event.dataTransfer.setData('class', event.target.className);
        event.dataTransfer.effectAllowed = 'move';
        newInput.classList.add('dragging');
    });

    newInput.addEventListener('dragend', () => {
        newInput.classList.remove('dragging');
    });

    // Append the new button to the drop area
    dropArea.appendChild(newInput);

    // Update the hidden input field with the current dropped items' values
    updateDroppedValues();
});

// Handle items being dragged back to the original container (vrewp-draggable-caps)
document.addEventListener('dragstart', (event) => {
    if (event.target && event.target.tagName.toLowerCase() === 'input') {
        event.target.classList.add('dragging');
    }
});

document.addEventListener('dragend', (event) => {
    if (event.target && event.target.tagName.toLowerCase() === 'input') {
        event.target.classList.remove('dragging');
    }
});

// Allow dropped items to be dragged back into the original container
vrewpDraggableCaps.addEventListener('dragover', (event) => {
    event.preventDefault();
    vrewpDraggableCaps.classList.add('drag-over');
});

vrewpDraggableCaps.addEventListener('dragleave', () => {
    vrewpDraggableCaps.classList.remove('drag-over');
});

vrewpDraggableCaps.addEventListener('drop', (event) => {
    event.preventDefault();
    vrewpDraggableCaps.classList.remove('drag-over');
    
    const draggedValue = event.dataTransfer.getData('text/plain');
    const draggedClass = event.dataTransfer.getData('class');

    // Find the item in the drop area and remove it
    const itemToRemove = [...dropArea.getElementsByTagName('input')].find(input => input.value === draggedValue);

    if (itemToRemove) {
        // Remove the item from the drop area
        dropArea.removeChild(itemToRemove);

        // Check if the item already exists in the original container to avoid duplicates
        const existingItem = [...vrewpDraggableCaps.getElementsByTagName('input')].find(input => input.value === draggedValue);
        if (!existingItem) {
            // Create a new input button for the original container
            const newInput = document.createElement('input');
            newInput.type = 'button';
            newInput.value = draggedValue;
            newInput.className = draggedClass; // Apply the same class to the new button
            newInput.setAttribute('draggable', 'true'); // Make it draggable again

            // Add event listeners for the new input to make it draggable again
            newInput.addEventListener('dragstart', (event) => {
                event.dataTransfer.setData('text/plain', event.target.value);
                event.dataTransfer.setData('class', event.target.className);
                event.dataTransfer.effectAllowed = 'move';
                newInput.classList.add('dragging');
            });

            newInput.addEventListener('dragend', () => {
                newInput.classList.remove('dragging');
            });

            // Append the new input back to the original container
            vrewpDraggableCaps.appendChild(newInput);
        }

        // Update the hidden input field with the current dropped items' values
        updateDroppedValues();
    }
});

// Function to update the hidden input with all dropped values in JSON format
function updateDroppedValues() {
    

    // Collect dropped items' values in a flat array (no nesting)
    const droppedValues = [...dropArea.getElementsByTagName('input')].map(input => input.value);

    // Initialize an array to store single values
    const flattenedValues = [];

    // Loop through each item in droppedValues
    droppedValues.forEach(value => {
        // Check if the value is not an array (skip if it's an array)
        if (!Array.isArray(value)) {
            flattenedValues.push(value); // Add the single value to the flattenedValues array
        }
    });

    // Set the hidden input value as a JSON string (no additional encoding)
    hiddenInput.value = JSON.stringify(flattenedValues);

}
