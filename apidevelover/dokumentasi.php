<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi API Artis Lokal</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #eef3f7;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #005bea, #00c6fb);
            padding: 40px 20px;
            text-align: center;
            color: white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 600;
        }
        header p {
            margin-top: 8px;
            font-size: 16px;
            opacity: 0.9;
        }

        .container {
            max-width: 950px;
            margin: 30px auto;
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            color: #005bea;
            border-left: 5px solid #00c6fb;
            padding-left: 10px;
            font-weight: 600;
        }

        h3 {
            color: #007bff;
            margin-top: 25px;
            font-weight: 600;
        }

        .endpoint {
            background: #e6f2ff;
            padding: 12px;
            border-left: 5px solid #007bff;
            border-radius: 5px;
            margin-bottom: 12px;
            font-family: monospace;
            font-size: 15px;
            word-break: break-all;
        }

        pre {
            background: #1e1e1e;
            color: #dcdcdc;
            padding: 20px;
            border-radius: 8px;
            font-size: 14px;
            overflow-x: auto;
            line-height: 1.5;
        }

        ul li {
            margin-bottom: 6px;
        }

        hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 30px 0;
        }
    </style>
</head>

<body>

<header>
    <h1>Dokumentasi API Artis Lokal</h1>
    <p>REST API berbasis Firebase Realtime Database</p>
</header>

<div class="container">

    <h2>1. Endpoint API</h2>
    <p>Gunakan URL berikut untuk mengambil semua data artis:</p>

    <div class="endpoint">
        https://restapiuaspraktek-artislokal-default-rtdb.firebaseio.com/artis.json?print=pretty
    </div>

    <hr>

    <h2>2. Contoh Response API</h2>
    <p>Berikut contoh data yang dikembalikan API:</p>

<pre>{
  "-OeiYB4ome7m2uP5_sDY": {
    "deskripsi": "Tulus adalah penyanyi dan penulis lagu Indonesia yang dikenal dengan suara khas dan lirik yang menyentuh.",
    "genre": "Pop",
    "jumlah_event": 12,
    "kategori": "Penyanyi",
    "kewarganegaraan": "Indonesia",
    "nama": "Tulus",
    "sosial": {
      "instagram": "https://www.instagram.com/daryat99/",
      "youtube": "tulus"
    },
    "tag": ["pop", "soul", "penyanyi"],
    "tahun_debut": 2011
  }
}
</pre>

    <hr>

    <h2>3. Cara Menggunakan API</h2>
    <p>API ini bersifat publik dan dapat digunakan tanpa token atau autentikasi.</p>

    <h3>A. Menggunakan JavaScript (Fetch API)</h3>
<pre>
// Mengambil data artis
fetch("https://restapiuaspraktek-artislokal-default-rtdb.firebaseio.com/artis.json")
    .then(res => res.json())
    .then(data => {
        console.log("Data artis:", data);
    });
</pre>

    <h3>B. Menggunakan PHP</h3>
<pre>
<?php
$data = file_get_contents("https://restapiuaspraktek-artislokal-default-rtdb.firebaseio.com/artis.json");
$data = json_decode($data, true);

foreach ($data as $id => $artis) {
    echo "Nama: " . $artis['nama'] . "&lt;br&gt;";
}
?>
</pre>

    <h3>C. Menggunakan cURL (Command Line)</h3>
<pre>
curl https://restapiuaspraktek-artislokal-default-rtdb.firebaseio.com/artis.json
</pre>

    <h3>D. Mengambil Data Berdasarkan ID</h3>
    <p>Contoh: Ambil 1 artis berdasarkan ID Firebase:</p>

    <div class="endpoint">
        https://restapiuaspraktek-artislokal-default-rtdb.firebaseio.com/artis/-OeiYB4ome7m2uP5_sDY.json
    </div>

<pre>
fetch("https://restapiuaspraktek-artislokal-default-rtdb.firebaseio.com/artis/-OeiYB4ome7m2uP5_sDY.json")
  .then(res => res.json())
  .then(data => console.log(data));
</pre>

    <h3>E. Filtering Nama (Manual Search)</h3>
<pre>
fetch("https://restapiuaspraktek-artislokal-default-rtdb.firebaseio.com/artis.json")
  .then(res => res.json())
  .then(data => {
      let hasil = Object.values(data).filter(a => a.nama.includes("Tulus"));
      console.log(hasil);
  });
</pre>

    <hr>

    <h2>4. Aturan Penggunaan</h2>
    <ul>
        <li>API hanya mendukung metode <strong>GET (read-only)</strong>.</li>
        <li>Tidak dapat menambah / mengubah / menghapus data.</li>
        <li>Data dapat digunakan untuk aplikasi, website, tugas, atau penelitian.</li>
    </ul>

    <hr>

    <h2>5. Aturan Keamanan Firebase</h2>
    <p>API hanya memberikan akses baca, tanpa izin menulis:</p>

<pre>{
  "rules": {
    ".read": true,
    ".write": false
  }
}
</pre>

</div>

</body>
</html>
