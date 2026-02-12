<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mapa - Servipyme Gramalote</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    body { margin: 0; }
    #map { height: 100vh; width: 100%; }
    .filtros {
      position: absolute;
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
      background: rgba(255,255,255,0.9);
      padding: 10px 20px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      font-family: Arial, sans-serif;
      display: flex;
      gap: 10px;
      z-index: 1000;
    }
    .filtros button {
      border: none;
      padding: 8px 15px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn-azul { background: #007bff; color: white; }
    .btn-rojo { background: #e63946; color: white; }
    .btn-gris { background: #6c757d; color: white; }
    .btn-azul:hover { background: #0056b3; }
    .btn-rojo:hover { background: #c1121f; }
    .btn-gris:hover { background: #495057; }
  </style>
</head>
<body>
  <div id="map"></div>

  <!-- Filtros -->
  <div class="filtros">
    <button class="btn-azul" onclick="mostrar('negocio')">🔵 Negocios</button>
    <button class="btn-rojo" onclick="mostrar('servicio')">🔴 Servicios</button>
    <button class="btn-gris" onclick="mostrar('todos')">🌐 Todos</button>
  </div>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    // Inicializar mapa centrado en Nuevo Gramalote
    const map = L.map('map').setView([7.6783, -72.7950], 14);

    // Fondo del mapa
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // Polígono del municipio
    fetch("gramalote.json")
      .then(res => res.json())
      .then(data => {
        L.geoJSON(data, {
          style: {
            color: "#003f80",
            weight: 3,
            fillColor: "#cce0ff",
            fillOpacity: 0.2
          }
        }).addTo(map);
      });

    // Iconos
    const negocioIcon = L.icon({
      iconUrl: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
      iconSize: [32, 32],
      iconAnchor: [16, 32],
      popupAnchor: [0, -32]
    });

    const servicioIcon = L.icon({
      iconUrl: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
      iconSize: [32, 32],
      iconAnchor: [16, 32],
      popupAnchor: [0, -32]
    });

    // Grupos de capas
    let grupoNegocios = L.layerGroup().addTo(map);
    let grupoServicios = L.layerGroup().addTo(map);

    // Cargar datos
    fetch("mapa.php")
      .then(res => res.json())
      .then(data => {
        data.forEach(item => {
          let icono = item.tipo === "negocio" ? negocioIcon : servicioIcon;
          let marker = L.marker([item.latitud, item.longitud], { icon: icono })
            .bindPopup(`<b>${item.nombre}</b><br>${item.ubicacion}<br><i>${item.tipo}</i>`);

          if (item.tipo === "negocio") {
            marker.addTo(grupoNegocios);
          } else {
            marker.addTo(grupoServicios);
          }
        });
      });

    // Función de filtros
    function mostrar(tipo) {
      map.removeLayer(grupoNegocios);
      map.removeLayer(grupoServicios);

      if (tipo === "negocio") {
        map.addLayer(grupoNegocios);
      } else if (tipo === "servicio") {
        map.addLayer(grupoServicios);
      } else {
        map.addLayer(grupoNegocios);
        map.addLayer(grupoServicios);
      }
    }
  </script>
</body>
</html>
