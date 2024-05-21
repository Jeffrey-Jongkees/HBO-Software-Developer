/**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
let map;
window.addEventListener("load", (event) => {
  initMap();
});

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
    "marker",
  );

  map = new Map(document.getElementById("map"), {
    center: { lat: 52.063796, lng: 5.104179 },
    zoom: 17,
    mapId: "4504f8b37365c3d0"
  });
  const markerViewWithText = new AdvancedMarkerElement({
    map,
    position: { lat: 52.063796, lng: 5.104179 },
    title: "Dit is de dans school locatie",
  });
 
  const pinScaled = new PinElement({
    scale: 1.5,
  });
}