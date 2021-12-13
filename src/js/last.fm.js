/**
 * Get album cover for a song
 * @param {string} track Track name
 * @param {strng} artist Artist name
 * @returns {string} album cover url
 */
async function getTrackCover(track, artist) {
  // let promise = new Promise(function (resolve) {
  //   let req = new XMLHttpRequest();
  //   req.open("GET", "../config/api.key", true);
  //   req.onreadystatechange = function () {
  //     if (req.readyState === 4) {
  //       if (req.status === 200 || req.status == 0) {
  //         var allText = req.responseText;
  //         resolve(allText);
  //       } else {
  //         resolve("File not found");
  //       }
  //     }
  //   };
  // });

  // TODO get key from file
  var key = "";

  // Request url
  const url =
    "https://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=" +
    key +
    "&artist=" +
    artist.toLowerCase() +
    "&track=" +
    track.toLowerCase();

  // Open request
  var xhr = new XMLHttpRequest();
  xhr.open("GET", url);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      // TODO look if undefined
      // Get response as XML
      xml = xhr.responseXML;
      console.log(xml);

      // Get data from XML
      const track = xml.getElementsByTagName("track")[0];
      const album = track.getElementsByTagName("album")[0];
      const images = album.getElementsByTagName("image");
      return images[images.length - 1].childNodes[0].nodeValue;
    }
  };

  xhr.send();
}

// function readTextFile(file) {
//   var rawFile = new XMLHttpRequest();
//   rawFile.open("GET", file, true);
//   rawFile.onreadystatechange = function () {
//     if (rawFile.readyState === 4) {
//       if (rawFile.status === 200 || rawFile.status == 0) {
//         var allText = rawFile.responseText;
//         alert(allText);
//         return Promise.resolve(allText);
//       }
//     }
//   };
//   rawFile.send(null);
// }
