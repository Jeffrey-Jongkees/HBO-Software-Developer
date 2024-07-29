function resizeInput(input) {
  input.style.width = input.value.length + "ch";
}

// Function to set width for all inputs based on the address input
function setUniformWidth(width) {
  const inputFields = document.querySelectorAll('input[type="text"]');
  inputFields.forEach(input => {
      input.style.width = width + "px";
  });
}

// Initialize the width based on initial value for the address field
document.addEventListener('DOMContentLoaded', (event) => {
  const adresInput = document.querySelector('#address');
  if (adresInput) {
      resizeInput(adresInput);
      const adresWidth = adresInput.offsetWidth;

      // Set the same width for all text input fields
      setUniformWidth(adresWidth);

      adresInput.addEventListener('input', function() {
          resizeInput(this);
          setUniformWidth(this.offsetWidth);
      });
  }
});
