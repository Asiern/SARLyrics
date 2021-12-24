/**
 * Validate form content
 * @param {form} form
 * @returns true <=> form valid
 */
function validateForm(form) {
  const title = form.title.value;
  const author = form.author.value;
  const album = form.album.value;
  const lyrics = form.lyrics.value;

  // TODO validate data
  // TODO show error msg
  if (title === "" || author === "" || album === "" || lyrics === "") {
    alert("Form fields cannot be empty");
    return false;
  }

  return true;
}

/**
 * Open lyrics from id
 * @param {string} id lyrics id
 */
function openLyrics(id) {
  redirect("/views/lyric.php?id=" + id);
}

/**
 * Redirect to href
 * @param {string} href
 */
function redirect(href) {
  window.location.href = href;
}

/**
 * Search for lyrics
 * @param {string} value
 */
function searchLyrics() {
  const search = document.getElementById("search").value;
  redirect("/views/lyrics.php?search=" + search);
}
