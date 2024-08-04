const tieneSoporteUserMedia = () =>
    !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);

const obtenerDispositivos = () => navigator.mediaDevices.enumerateDevices();

const limpiarSelect = () => {
    for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--) {
        $listaDeDispositivos.remove(x);
    }
};

const llenarSelectConDispositivosDisponibles = () => {
    limpiarSelect();
    obtenerDispositivos()
        .then(dispositivos => {
            const dispositivosDeVideo = [];
            dispositivos.forEach(dispositivo => {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            if (dispositivosDeVideo.length > 0) {
                dispositivosDeVideo.forEach(dispositivo => {
                    const option = document.createElement('option');
                    option.value = dispositivo.deviceId;
                    option.text = dispositivo.label;
                    $listaDeDispositivos.appendChild(option);
                });
            }
        });
};

const mostrarStream = idDeDispositivo => {
    navigator.mediaDevices.getUserMedia({
        video: {
            deviceId: idDeDispositivo,
        }
    })
    .then(streamObtenido => {
        llenarSelectConDispositivosDisponibles();

        $listaDeDispositivos.onchange = () => {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            mostrarStream($listaDeDispositivos.value);
        };

        stream = streamObtenido;
        $video.srcObject = stream;
        $video.play();

        $boton.addEventListener("click", () => {
            $video.pause();
            let contexto = $canvas.getContext("2d");
            $canvas.width = $video.videoWidth;
            $canvas.height = $video.videoHeight;
            contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

            let foto = $canvas.toDataURL();
            $estado.innerHTML = "Enviando foto. Por favor, espera...";
            fetch("./guardar_foto.php", {
                method: "POST",
                body: encodeURIComponent(foto),
                headers: {
                    "Content-type": "application/x-www-form-urlencoded",
                }
            })
            .then(resultado => resultado.text())
            .then(idFoto => {
                console.log("La foto fue enviada correctamente");
                $estado.innerHTML = `Foto guardada con éxito. Puedes verla <a target='_blank' href='./ver.php?id=${idFoto}'> aquí</a>`;
            });

            $video.play();
        });
    })
    .catch(error => {
        console.log("Permiso denegado o error: ", error);
        $estado.innerHTML = "No se puede acceder a la cámara, o no diste permiso.";
    });
};

document.addEventListener("DOMContentLoaded", () => {
    if (!tieneSoporteUserMedia()) {
        alert("Lo siento. Tu navegador no soporta esta característica");
        $estado.innerHTML = "Parece que tu navegador no soporta esta característica. Intenta actualizarlo.";
        return;
    }

    let stream;
    obtenerDispositivos()
    .then(dispositivos => {
        const dispositivosDeVideo = [];
        dispositivos.forEach(dispositivo => {
            if (dispositivo.kind === "videoinput") {
                dispositivosDeVideo.push(dispositivo);
            }
        });

        if (dispositivosDeVideo.length > 0) {
            mostrarStream(dispositivosDeVideo[0].deviceId);
        }
    });
});
