function contactMenu(contact) {
  contact.addEventListener('touchstart', (e) => {
    e.preventDefault();
  });
  contact.addEventListener('touchend', (e) => {
    e.preventDefault();
  });
}

function contactsEventListeners () {
  const contacts = document.getElementsByClassName('contact');
  contacts.forEach(contact => {
    contactMenu(contact);
  });
}

contactsEventListeners();
