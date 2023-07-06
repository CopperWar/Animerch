const track = document.getElementById("image-track");

window.onmousedown = e => {
  track.dataset.mouseDownAt = e.clientX;
  track.dataset.prevPercentage = track.dataset.percentage || "0";
};

window.onmouseup = () => {
  track.dataset.mouseDownAt = "0";
  track.dataset.prevPercentage = track.dataset.percentage;
};

window.onmousemove = e => {
  if (track.dataset.mouseDownAt === "0") return;
  const mouseDelta = parseFloat(track.dataset.mouseDownAt) - e.clientX;
  const maxDelta = window.innerWidth / 2;

  const percentage = (mouseDelta / maxDelta) * -100;
  const nextPercentage = parseFloat(track.dataset.prevPercentage) + percentage;
  const minPercentage = -100; // Minimum value for nextPercentage
  const maxPercentage = 0; // Maximum value for nextPercentage

  track.dataset.percentage = Math.min(maxPercentage, Math.max(minPercentage, nextPercentage));
  track.style.transform = `translate(${track.dataset.percentage}%, -50%)`;

  for (const image of track.getElementsByClassName("image")) {
    image.style.transition = "object-position 1.2s";
    image.style.objectPosition = `${100 + nextPercentage}% center`;
  }
};

function redirectTo(url) {
  window.location.href = url;
}