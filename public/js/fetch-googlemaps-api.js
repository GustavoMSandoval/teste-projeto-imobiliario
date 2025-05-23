/**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
// [START maps_add_map]
// Initialize and add the map
let map;

async function initMap() {
  // [START maps_add_map_instantiate_map]
  // The location of Uluru
  const position = { lat: parseFloat(window.houseData.lat),
    lng: parseFloat(window.houseData.lng) };
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  // The map, centered at Uluru
  map = new Map(document.getElementById("map"), {
    zoom: 17,
    center: position,
    mapId: "DEMO_MAP_ID",
  });

  // [END maps_add_map_instantiate_map]
  // [START maps_add_map_instantiate_marker]
  // The marker, positioned at Uluru
  const marker = new AdvancedMarkerElement({
    map: map,
    position: position,
    title: window.houseData.title,
  });
  // [END maps_add_map_instantiate_marker]
}

initMap();
// [END maps_add_map]