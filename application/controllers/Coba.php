<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coba extends CI_Controller
{
    public function index()
    {
        // $this->load->view('coba');
        // ===PROSES CASE FOLDING===
        $kalimat_asli = $this->db->query("SELECT data_uji FROM uji")->row_array();
        // $q_kode = 'q';
        echo "Data Awal";
        print_r("<pre>");
        print_r($kalimat_asli['data_uji']);
        print_r("</pre>");
        // $inputkan = mysqli_query($conn, "INSERT INTO query VALUES('','$kalimat_asli')");

        $kalimat = strtolower($kalimat_asli['data_uji']); //proses pengubahan huruf alfabet kapital menjadi kecil

        //hilangkan tanda baca
        $kalimat = str_replace("'", "", $kalimat);
        $kalimat = str_replace("-", "", $kalimat);
        $kalimat = str_replace(")", "", $kalimat);
        $kalimat = str_replace("(", "", $kalimat);
        $kalimat = str_replace("\"", "", $kalimat);
        $kalimat = str_replace("/", "", $kalimat);
        $kalimat = str_replace("=", "", $kalimat);
        $kalimat = str_replace(".", "", $kalimat);
        $kalimat = str_replace(",", "", $kalimat);
        $kalimat = str_replace(":", "", $kalimat);
        $kalimat = str_replace(";", "", $kalimat);
        $kalimat = str_replace("!", "", $kalimat);
        $kalimat = str_replace("?", "", $kalimat);
        $kalimat = str_replace("`", "", $kalimat);
        $kalimat = str_replace("~", "", $kalimat);
        $kalimat = str_replace("@", "", $kalimat);
        $kalimat = str_replace("#", "", $kalimat);
        $kalimat = str_replace("$", "", $kalimat);
        $kalimat = str_replace("%", "", $kalimat);
        $kalimat = str_replace("^", "", $kalimat);
        $kalimat = str_replace("&", "", $kalimat);
        $kalimat = str_replace("*", "", $kalimat);
        $kalimat = str_replace("_", "", $kalimat);
        $kalimat = str_replace("+", "", $kalimat);
        $kalimat = str_replace("[", "", $kalimat);
        $kalimat = str_replace("]", "", $kalimat);
        $kalimat = str_replace("<", "", $kalimat);
        $kalimat = str_replace(">", "", $kalimat);

        echo "Case Folding";
        print_r("<pre>");
        print_r(trim($kalimat));
        print_r("</pre>");

        // ===AKHIR PROSES CASE FOLDING===

        // ===PROSES TOKENIZING===

        $token = str_word_count(strtolower($kalimat), 1);

        echo "Tokenizing";
        print_r("<pre>");
        print_r($token);
        print_r("</pre>");

        // ===AKHIR PROSES TOKENIZING===

        // ===PROSES FILTERING===

        $stopwords = array("ada", "adalah", "adanya", "adapun", "agak", "agaknya", "agar", "akan", "akankah", "akhir", "akhiri", "akhirnya", "aku", "akulah", "amat", "amatlah", "anda", "andalah", "antar", "antara", "antaranya", "apa", "apaan", "apabila", "apakah", "apalagi", "apatah", "artinya", "asal", "asalkan", "atas", "atau", "ataukah", "ataupun", "awal", "awalnya", "bagai", "bagaikan", "bagaimana", "bagaimanakah", "bagaimanapun", "bagi", "bagian", "bahkan", "bahwa", "bahwasanya", "baik", "bakal", "bakalan", "balik", "banyak", "bapak", "baru", "bawah", "beberapa", "begini", "beginian", "beginikah", "beginilah", "begitu", "begitukah", "begitulah", "begitupun", "bekerja", "belakang", "belakangan", "belum", "belumlah", "benar", "benarkah", "benarlah", "berada", "berakhir", "berakhirlah", "berakhirnya", "berapa", "berapakah", "berapalah", "berapapun", "berarti", "berawal", "berbagai", "berdatangan", "beri", "berikan", "berikut", "berikutnya", "berjumlah", "berkali-kali", "berkata", "berkehendak", "berkeinginan", "berkenaan", "berlainan", "berlalu", "berlangsung", "berlebihan", "bermacam", "bermacam-macam", "bermaksud", "bermula", "bersama", "bersama-sama", "bersiap", "bersiap-siap", "bertanya", "bertanya-tanya", "berturut", "berturut-turut", "bertutur", "berujar", "berupa", "besar", "betul", "betulkah", "biasa", "biasanya", "bila", "bilakah", "bisa", "bisakah", "boleh", "bolehkah", "bolehlah", "buat", "bukan", "bukankah", "bukanlah", "bukannya", "bulan", "bung", "cara", "caranya", "cukup", "cukupkah", "cukuplah", "cuma", "dahulu", "dalam", "dan", "dapat", "dari", "daripada", "datang", "dekat", "demi", "demikian", "demikianlah", "dengan", "depan", "di", "dia", "diakhiri", "diakhirinya", "dialah", "diantara", "diantaranya", "diberi", "diberikan", "diberikannya", "dibuat", "dibuatnya", "didapat", "didatangkan", "digunakan", "diibaratkan", "diibaratkannya", "diingat", "diingatkan", "diinginkan", "dijawab", "dijelaskan", "dijelaskannya", "dikarenakan", "dikatakan", "dikatakannya", "dikerjakan", "diketahui", "diketahuinya", "dikira", "dilakukan", "dilalui", "dilihat", "dimaksud", "dimaksudkan", "dimaksudkannya", "dimaksudnya", "diminta", "dimintai", "dimisalkan", "dimulai", "dimulailah", "dimulainya", "dimungkinkan", "dini", "dipastikan", "diperbuat", "diperbuatnya", "dipergunakan", "diperkirakan", "diperlihatkan", "diperlukan", "diperlukannya", "dipersoalkan", "dipertanyakan", "dipunyai", "diri", "dirinya", "disampaikan", "disebut", "disebutkan", "disebutkannya", "disini", "disinilah", "ditambahkan", "ditandaskan", "ditanya", "ditanyai", "ditanyakan", "ditegaskan", "ditujukan", "ditunjuk", "ditunjuki", "ditunjukkan", "ditunjukkannya", "ditunjuknya", "dituturkan", "dituturkannya", "diucapkan", "diucapkannya", "diungkapkan", "dong", "dua", "dulu", "empat", "enggak", "enggaknya", "entah", "entahlah", "guna", "gunakan", "hal", "hampir", "hanya", "hanyalah", "hari", "harus", "haruslah", "harusnya", "hendak", "hendaklah", "hendaknya", "hingga", "ia", "ialah", "ibarat", "ibaratkan", "ibaratnya", "ibu", "ikut", "ingat", "ingat-ingat", "ingin", "inginkah", "inginkan", "ini", "inikah", "inilah", "itu", "itukah", "itulah", "jadi", "jadilah", "jadinya", "jangan", "jangankan", "janganlah", "jauh", "jawab", "jawaban", "jawabnya", "jelas", "jelaskan", "jelaslah", "jelasnya", "jika", "jikalau", "juga", "jumlah", "jumlahnya", "justru", "kala", "kalau", "kalaulah", "kalaupun", "kalian", "kami", "kamilah", "kamu", "kamulah", "kan", "kapan", "kapankah", "kapanpun", "karena", "karenanya", "kasus", "kata", "katakan", "katakanlah", "katanya", "ke", "keadaan", "kebetulan", "kecil", "kedua", "keduanya", "keinginan", "kelamaan", "kelihatan", "kelihatannya", "kelima", "keluar", "kembali", "kemudian", "kemungkinan", "kemungkinannya", "kenapa", "kepada", "kepadanya", "kesampaian", "keseluruhan", "keseluruhannya", "keterlaluan", "ketika", "khususnya", "kini", "kinilah", "kira", "kira-kira", "kiranya", "kita", "kitalah", "kok", "kurang", "lagi", "lagian", "lah", "lain", "lainnya", "lalu", "lama", "lamanya", "lanjut", "lanjutnya", "lebih", "lewat", "lima", "luar", "macam", "maka", "makanya", "makin", "malah", "malahan", "mampu", "mampukah", "mana", "manakala", "manalagi", "masa", "masalah", "masalahnya", "masih", "masihkah", "masing", "masing-masing", "mau", "maupun", "melainkan", "melakukan", "melalui", "melihat", "melihatnya", "memang", "memastikan", "memberi", "memberikan", "membuat", "memerlukan", "memihak", "meminta", "memintakan", "memisalkan", "memperbuat", "mempergunakan", "memperkirakan", "memperlihatkan", "mempersiapkan", "mempersoalkan", "mempertanyakan", "mempunyai", "memulai", "memungkinkan", "menaiki", "menambahkan", "menandaskan", "menanti", "menanti-nanti", "menantikan", "menanya", "menanyai", "menanyakan", "mendapat", "mendapatkan", "mendatang", "mendatangi", "mendatangkan", "menegaskan", "mengakhiri", "mengapa", "mengatakan", "mengatakannya", "mengenai", "mengerjakan", "mengetahui", "menggunakan", "menghendaki", "mengibaratkan", "mengibaratkannya", "mengingat", "mengingatkan", "menginginkan", "mengira", "mengucapkan", "mengucapkannya", "mengungkapkan", "menjadi", "menjawab", "menjelaskan", "menuju", "menunjuk", "menunjuki", "menunjukkan", "menunjuknya", "menurut", "menuturkan", "menyampaikan", "menyangkut", "menyatakan", "menyebutkan", "menyeluruh", "menyiapkan", "merasa", "mereka", "merekalah", "merupakan", "meski", "meskipun", "meyakini", "meyakinkan", "minta", "mirip", "misal", "misalkan", "misalnya", "mula", "mulai", "mulailah", "mulanya", "mungkin", "mungkinkah", "nah", "naik", "namun", "nanti", "nantinya", "nyaris", "nyatanya", "oleh", "olehnya", "pada", "padahal", "padanya", "pak", "paling", "panjang", "pantas", "para", "pasti", "pastilah", "penting", "pentingnya", "per", "percuma", "perlu", "perlukah", "perlunya", "pernah", "persoalan", "pertama", "pertama-tama", "pertanyaan", "pertanyakan", "pihak", "pihaknya", "pukul", "pula", "pun", "punya", "rasa", "rasanya", "rata", "rupanya", "saat", "saatnya", "saja", "sajalah", "saling", "sama", "sama-sama", "sambil", "sampai", "sampai-sampai", "sampaikan", "sana", "sangat", "sangatlah", "satu", "saya", "sayalah", "se", "sebab", "sebabnya", "sebagai", "sebagaimana", "sebagainya", "sebagian", "sebaik", "sebaik-baiknya", "sebaiknya", "sebaliknya", "sebanyak", "sebegini", "sebegitu", "sebelum", "sebelumnya", "sebenarnya", "seberapa", "sebesar", "sebetulnya", "sebisanya", "sebuah", "sebut", "sebutlah", "sebutnya", "secara", "secukupnya", "sedang", "sedangkan", "sedemikian", "sedikit", "sedikitnya", "seenaknya", "segala", "segalanya", "segera", "seharusnya", "sehingga", "seingat", "sejak", "sejauh", "sejenak", "sejumlah", "sekadar", "sekadarnya", "sekali", "sekali-kali", "sekalian", "sekaligus", "sekalipun", "sekarang", "sekarang", "sekecil", "seketika", "sekiranya", "sekitar", "sekitarnya", "sekurang-kurangnya", "sekurangnya", "sela", "selain", "selaku", "selalu", "selama", "selama-lamanya", "selamanya", "selanjutnya", "seluruh", "seluruhnya", "semacam", "semakin", "semampu", "semampunya", "semasa", "semasih", "semata", "semata-mata", "semaunya", "sementara", "semisal", "semisalnya", "sempat", "semua", "semuanya", "semula", "sendiri", "sendirian", "sendirinya", "seolah", "seolah-olah", "seorang", "sepanjang", "sepantasnya", "sepantasnyalah", "seperlunya", "seperti", "sepertinya", "sepihak", "sering", "seringnya", "serta", "serupa", "sesaat", "sesama", "sesampai", "sesegera", "sesekali", "seseorang", "sesuatu", "sesuatunya", "sesudah", "sesudahnya", "setelah", "setempat", "setengah", "seterusnya", "setiap", "setiba", "setibanya", "setidak-tidaknya", "setidaknya", "setinggi", "seusai", "sewaktu", "siap", "siapa", "siapakah", "siapapun", "sini", "sinilah", "soal", "soalnya", "suatu", "sudah", "sudahkah", "sudahlah", "supaya", "tadi", "tadinya", "tahu", "tahun", "tak", "tambah", "tambahnya", "tampak", "tampaknya", "tandas", "tandasnya", "tanpa", "tanya", "tanyakan", "tanyanya", "tapi", "tegas", "tegasnya", "telah", "tempat", "tengah", "tentang", "tentu", "tentulah", "tentunya", "tepat", "terakhir", "terasa", "terbanyak", "terdahulu", "terdapat", "terdiri", "terhadap", "terhadapnya", "teringat", "teringat-ingat", "terjadi", "terjadilah", "terjadinya", "terkira", "terlalu", "terlebih", "terlihat", "termasuk", "ternyata", "tersampaikan", "tersebut", "tersebutlah", "tertentu", "tertuju", "terus", "terutama", "tetap", "tetapi", "tiap", "tiba", "tiba-tiba", "tidak", "tidakkah", "tidaklah", "tiga", "tinggi", "toh", "tunjuk", "turut", "tutur", "tuturnya", "ucap", "ucapnya", "ujar", "ujarnya", "umum", "umumnya", "ungkap", "ungkapnya", "untuk", "usah", "usai", "waduh", "wah", "wahai", "waktu", "waktunya", "walau", "walaupun", "wong", "yaitu", "yakin", "yakni", "yang");

        //menghapus kata yang tidak penting (stopword removing dan steming)
        $astoplist = array(
            ' di', ' ke', ' se', 'ada ', 'adalah', 'adanya', 'adapun', 'agak ', 'agaknya', 'agar ', ' akan ', 'akankah', 'akhir', 'lah', 'kah',
            'akhiri', 'akhirnya', ' aku ', 'akulah', 'amat', 'amatlah', 'anda', 'andalah', 'antar', 'antara',
            'antaranya', 'apa', 'apaan', 'apabila', 'apakah', 'apalagi', 'apatah', 'arti', 'artinya', 'asal',
            'asalkan', 'atas', 'atau', 'ataukah', 'ataupun', 'awal', 'awalnya', 'bagai', 'bagaikan',
            'bagaimana', 'bagaimanakah', 'bagaimanapun', 'bagainamakah', 'bagi', 'bagian', 'bahkan', 'bahwa',
            'bahwasannya', 'bahwasanya', ' baik ', 'belas', 'baiklah', 'bakal', 'bakalan', 'balik', 'banyak', 'bapak',
            'beberapa', 'begini', 'beginian', 'beginikah', 'beginilah', 'begitu', 'begitukah', 'begitulah',
            'begitupun', 'belakangan', 'belumlah', 'benarkah', 'benarlah', 'berada', 'berakhir', 'berakhirlah',
            'berakhirnya', 'berapa', 'berapakah', 'berapalah', 'berapapun', 'berarti', 'berawal', 'berbagai',
            'berdatangan', 'berikan', 'berikut', 'berikutnya', 'berjumlah', 'berkali-kali', 'berkata',
            'berkehendak', 'berkeinginan', 'berkenaan', 'berlainan', 'berlalu', 'berlangsung', 'berlebihan',
            'bermacam', 'bermacam-macam', 'bermaksud', 'bermula', 'bersama', 'bersama-sama', 'bersiap',
            'bersiap-siap', 'bertanya', 'bertanya-tanya', 'berturut', 'berturut-turut', 'bertutur', 'berujar',
            'berupa', 'besar', 'betul', 'betulkah', 'biasa', 'biasanya', 'bila', 'bilakah', 'bisa', 'bisakah', 'boleh',
            'bolehkah', 'bolehlah', 'buat', 'bukan', 'bukankah', 'bukanlah', 'bukannya', 'bulan', 'bung',
            'caranya', 'cukup', 'cukupkah', 'cukuplah', 'cuma', 'dahulu', 'dalam', ' dan ', 'dapat', 'dari',
            'daripada', 'datang', ' dekat ', ' demi ', 'demikian', 'demikianlah', 'dengan', 'depan', 'dia',
            'diakhiri', 'diakhirinya', 'dialah', 'diantara', 'diantaranya', 'diberi', 'diberikan', 'diberikannya',
            'dibuat', 'dibuatnya', 'didapat', 'didatangkan', 'digunakan', 'diibaratkan', 'diibaratkannya',
            'diingat', 'diingatkan', 'diinginkan', 'dijawab', 'dijelaskan', 'dijelaskannya', 'dikarenakan',
            'dikatakan', 'dikatakannya', 'dikerjakan', 'diketahui', 'diketahuinya', 'dikira', 'dilakukan',
            'dilalui', 'dilihat', 'dimaksud', 'dimaksudkan', 'dimaksudkannya', 'dimaksudnya', 'diminta',
            'dimintai', 'dimisalkan', 'dimulai', 'dimulailah', 'dimulainya', 'dimungkinkan', 'dini', 'dipastikan',
            'diperbuat', 'diperbuatnya', 'dipergunakan', 'diperkirakan', 'diperlihatkan', 'diperlukan',
            'diperlukannya', 'dipersoalkan', 'dipertanyakan', 'dipunyai', 'diri', 'dirinya', 'disampaikan',
            'disebut', 'disebutkan', 'disebutkannya', 'disini', 'disinilah', 'ditambahkan', 'ditandaskan',
            'ditanya', 'ditanyai', 'ditanyakan', 'ditegaskan', 'ditujukan', 'ditunjuk', 'ditunjuki', 'ditunjukkan',
            'ditunjukkannya', 'ditunjuknya', 'dituturkan', 'dituturkannya', 'diucapkan', 'diucapkannya',
            'diungkapkan', 'dong', 'dua', 'dulu', 'empat', 'enak', 'enggak', 'enggaknya', 'entah', 'entahlah',
            'guna', 'gunakan', 'hadap', 'hai', 'hal', 'halo', 'hallo', 'hampir', 'hanya', 'hanyalah',
            'hari', 'harus', 'haruslah', 'harusnya', 'helo', 'hello', 'hendak', 'hendaklah', 'hendaknya', 'hingga',
            ' ia ', 'ialah', 'ibarat', 'ibaratkan', 'ibaratnya', 'ibu', 'ikut', 'ingat', 'ingat-ingat', 'ingin',
            'inginkah', 'inginkan', ' ini ', 'inikah', 'inilah', 'itu', 'itukah', 'itulah', ' jadi ', 'jadilah',
            'jadinya', 'jangan', 'jangankan', 'janganlah', 'jauh', 'jawab', 'jawaban', 'jawabnya', 'jelas',
            'jelaskan', 'jelaslah', 'jelasnya', 'jika', 'jikalau', 'juga', 'jumlah', 'jumlahnya', 'justru',
            'kadar', 'kala', 'kalau', 'kalaulah', 'kalaupun', 'kali', 'kalian', 'kami', 'kamilah', 'kamu',
            'kamulah', 'kapan', 'kapankah', 'kapanpun', 'karena', 'karenanya', 'kasus', 'kata', 'katakan',
            'katakanlah', 'katanya', 'keadaan', 'kebetulan', 'kecil', 'kedua', 'keduanya', 'keinginan',
            'kelamaan', 'kelihatan', 'kelihatannya', 'kelima', 'keluar', 'kembali', 'kemudian', 'kemungkinan',
            'kemungkinannya', 'kena', 'kenapa', 'kepada', 'kepadanya', 'kerja', 'kesampaian', 'keseluruhan',
            'keseluruhannya', 'keterlaluan', 'ketika', 'khusus', 'khususnya', 'kini', 'kinilah', 'kira',
            'kira-kira', 'kiranya', 'kita', 'kitalah', 'kok', 'kurang', 'lagi', 'lagian', 'lain',
            'lainnya', 'laku', 'lalu', 'lama', 'lamanya', 'langsung', 'lanjut', 'lanjutnya', 'lebih', 'lewat',
            'lihat', 'lima', 'luar', 'macam', 'maka ', 'makanya', 'makin ', 'maksud', 'malah', 'malahan',
            'mampu', 'mampukah', 'mana', 'manakala', 'manalagi', 'masa', 'masalah', 'masalahnya', 'masih',
            'masihkah', 'masing', 'masing-masing', 'masuk', 'mata', 'mau', 'maupun', 'melainkan', 'melakukan',
            'melalui', 'melihat', 'melihatnya', 'memang', 'memastikan', 'memberi', 'memberikan', 'membuat',
            'memerlukan', 'memihak', 'meminta', 'memintakan', 'memisalkan', 'memperbuat', 'mempergunakan',
            'memperkirakan', 'memperlihatkan', 'mempersiapkan', 'mempersoalkan', 'mempertanyakan', 'mempunyai',
            'memulai', 'memungkinkan', 'menaiki', 'menambahkan', 'menandaskan', 'menanti', 'menanti-nanti',
            'menantikan', 'menanya', 'menanyai', 'menanyakan', 'mendapat', 'mendapatkan', 'mendatang', 'mendatangi',
            'mendatangkan', 'menegaskan', 'mengakhiri', 'mengapa', 'mengatakan', 'mengatakannya', 'mengenai',
            'mengerjakan', 'mengetahui', 'menggunakan', 'menghendaki', 'mengibaratkan', 'mengibaratkannya',
            'mengingat', 'mengingatkan', 'menginginkan', 'mengira', 'mengucapkan', 'mengucapkannya', 'mengungkapkan',
            'menjadi', 'menjawab', 'menjelaskan', 'menuju', 'menunjuk', 'menunjuki', 'menunjukkan', 'menunjuknya',
            'menurut', 'menuturkan', 'menyampaikan', 'menyangkut', 'menyatakan', 'menyebutkan', 'menyeluruh',
            'menyiapkan', 'merasa', 'mereka', 'merekalah', 'merupakan', 'meski', 'meskipun', 'meyakini', 'meyakinkan',
            'minta', 'mirip', 'misal', 'misalkan', 'misalnya', 'mohon', ' mula ', ' muat ', 'mulai', 'mulailah', 'mulanya', 'mungkin',
            'mungkinkah', 'naik', 'namun', 'nanti', 'nantinya', 'nya', 'nyaris', 'nyata', 'nyatanya',
            'oleh', 'olehnya', 'orang', 'pada', 'padahal', 'padanya', ' pak ', 'paling', 'panjang', 'pantas',
            'para', 'pasti', 'pastilah', 'penting', 'pentingnya', 'per', 'percuma', 'perlu', 'perlukah', 'perlunya',
            'pernah', 'persoalan', 'pertama', 'pertama-tama', 'pertanyaan', 'pertanyakan', 'pihak', 'pihaknya',
            'pukul', ' pula ', 'pun', 'punya', 'rasa', 'rasanya', 'rupa', 'rupanya', 'saat', 'saatnya', 'saja',
            'sajalah', 'salam', 'saling', 'sama', 'sama-sama', 'sambil', 'sampai', 'sampai-sampai', 'sampaikan', 'sana',
            'sangat', 'sangatlah', 'sangkut', 'satu', 'saya ', 'sayalah', 'sebab', 'sebabnya', 'sebagai',
            'sebagaimana', 'sebagainya', 'sebagian', 'sebaik', 'sebaik-baiknya', 'sebaiknya', 'sebaliknya',
            'sebanyak', 'sebegini', 'sebegitu', 'sebelum', 'sebelumnya', 'sebenarnya', 'seberapa', 'sebesar',
            'sebetulnya', 'sebisanya', 'sebuah', 'sebut', 'sebutlah', 'sebutnya', 'secara', 'secukupnya', 'sedang',
            'sedangkan', 'sedemikian', 'sedikit', 'sedikitnya', 'seenaknya', 'segala', 'segalanya', 'segera',
            'seharusnya', 'sehingga', 'seingat', 'sejak', 'sejauh', 'sejenak', 'sejumlah', 'sekadar', 'sekadarnya',
            'sekali', 'sekali-kali', 'sekalian', 'sekaligus', 'sekalipun', 'sekarang', 'sekaranglah', 'sekecil',
            'seketika', 'sekiranya', 'sekitar', 'sekitarnya', 'sekurang-kurangnya', 'sekurangnya', 'sela', 'selain',
            'selaku', 'selalu', 'selama', 'selama-lamanya', 'selamanya', 'selanjutnya', 'seluruh', 'seluruhnya',
            'semacam', 'semakin', 'semampu', 'semampunya', 'semasa', 'semasih', 'semata', 'semata-mata', 'semaunya',
            'sementara', 'semisal', 'semisalnya', 'sempat', 'semua', 'semuanya', 'semula', 'sendiri', 'sendirian',
            'sendirinya', 'seolah', 'seolah-olah', 'seorang', 'sepanjang', 'sepantasnya', 'sepantasnyalah',
            'seperlunya', 'seperti', 'sepertinya', 'sepihak', 'sering', 'seringnya', 'serta', 'serupa', 'sesaat',
            'sesama', 'sesampai', 'sesegera', 'sesekali', 'seseorang', 'sesuatu', 'sesuatunya', 'sesudah',
            'sesudahnya', 'setelah', 'setempat', 'setengah', 'seterusnya', 'setiap', 'setiba', 'setibanya',
            'setidak-tidaknya', 'setidaknya', 'setinggi', 'seusai', 'sewaktu', 'siap', 'siapa', 'siapakah',
            'siapapun', 'sini', 'sinilah', 'soal', 'soalnya', 'suatu', 'sudah', 'sudahkah', 'sudahlah', 'supaya',
            'tadi', 'tadinya', 'tahu', 'tak', 'tambah', 'tambahnya', 'tampak', 'tampaknya', 'tandas', 'tandasnya',
            'tanpa', 'tanya', 'tanyakan', 'tanyanya', ' tapi ', 'tegas', 'tegasnya', 'telah', 'tempat', 'tentang', 'tentu',
            'tentulah', 'tentunya', 'tepat', 'terakhir', 'terasa', 'terbanyak', 'terdahulu', 'terdapat', 'terdiri',
            'terhadap', 'terhadapnya', 'teringat', 'teringat-ingat', 'terjadi', 'terjadilah', 'terjadinya', 'terkira',
            'terlalu', 'terlebih', 'terlihat', 'termasuk', 'ternyata', 'tersampaikan', 'tersebut', 'tersebutlah',
            'tertentu', 'tertuju', 'terus', 'terutama', 'tetap', 'tetapi', 'tiap', 'tiba', 'tiba-tiba', 'tidak',
            'tidakkah', 'tidaklah', 'tiga', 'toh', 'tuju', 'tunjuk', 'turut', 'tutur', 'tuturnya', 'ucap', 'ucapnya',
            'ujar', 'ujarnya', 'umumnya', 'ungkap', 'ungkapnya', 'untuk', 'usah', 'usai', 'waduh', 'wah', 'wahai',
            'waktunya', 'walau', 'walaupun', 'wong', ' ya ', 'yaitu', 'yakin', 'yakni', ' ng ', ' sa ', ' a ',
            ' b ', ' c ', ' d ', ' e ', ' f ', ' g ', ' h ', ' i ', ' j ', ' k ', ' l ', ' m ', ' n ', ' o ', ' p ', ' q ',
            ' r ', ' s ', ' t ', ' u ', ' v ', ' w ', ' x ', ' y ', ' z ', ' ja ', ' jak ', ' ta ', ' jum ', ' meng ',
            ' kan ', ' no ', ' si ', ' mua ', ' nah ', ' nal ', ' airan ', ' kel ', ' gala ', ' kou ', ' san ', ' ber ',
            ' hu ', ' dr ', ' spb ', ' onk ', ' him ', ' ti ', ' apkli ', ' gkiri ', ' te ', ' kg ', ' bps ', ' menc ',
            ' kkp ', ' yang ', ' mesti ', ' pilih ', ' bersungut ', ' pudar ', ' ndalikan ', ' dradjat ',
            'benar', 'jenis', 'kota', 'produksi', 'badan', ' mi ', ' but ', ' tara ', ' me ', ' angg ', ' rta ', ' but ',
            ' ter ', ' trnas ', ' pe ', ' ring ', ' kit ', ' wasp ', ' la ', ' pisu ', ' tiong ', ' br ', ' lu ', ' mem ',
            ' â€ ', ' nin ', ' inst ', ' ipb ', ' ms ', ' â€œberita ', ' ma ', ' tika ', ' gkas ', ' an ', ' tr ', ' nners ',
            ' su ', ' luk ', ' nali ', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
        );

        $output = array_diff($token, $astoplist);
        $output2 = array_diff($output, $stopwords);

        echo "Filtering";
        print_r("<pre>");
        print_r($output2);
        print_r("</pre>");

        // ===AKHIR PROSES FILTERING===

        // ===PROSES STEMMING===

        $arr = array_values($output2);
        for ($i = 0; $i < count($arr); $i++) {
            $val[] = stemming($arr[$i]);
        }

        echo "Stemming";
        print_r("<pre>");
        print_r($val);
        print_r("</pre>");

        // ===AKHIR PROSES STEMMING===
    }
}
