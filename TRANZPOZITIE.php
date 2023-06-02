

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $plaintext = $_POST["plaintext"];

        // Functia de incriptare a tanspozitiei
        function encryptByTransposition($plaintext) {
            // Stergerea spatilor libere din textul simplu
            $plaintext = str_replace(' ', '', $plaintext);
            
            // Determinarea dimensiunii matricei patratice
            $length = strlen($plaintext);
            $sqrtLength = ceil(sqrt($length));
            $padding = $sqrtLength * $sqrtLength - $length;
            $plaintext .= str_repeat('_', $padding);
            
            // Crearea matricei patratice si populrea acesteia
            $matrix = array();
            $index = 0;
            for ($i = 0; $i < $sqrtLength; $i++) {
                $row = array();
                for ($j = 0; $j < $sqrtLength; $j++) {
                    $row[] = $plaintext[$index];
                    $index++;
                }
                $matrix[] = $row;
            }
            
            // Cititrea matricei coloana cu coloana si concatenarea acesteia
            $ciphertext = '';
            for ($j = 0; $j < $sqrtLength; $j++) {
                for ($i = 0; $i < $sqrtLength; $i++) {
                    $ciphertext .= $matrix[$i][$j];
                }
            }
            
            return $ciphertext;
        }

        $ciphertext = encryptByTransposition($plaintext);

        echo "<h3>Results:</h3>";
        echo "<p><strong>Plaintext:</strong> " . htmlspecialchars($plaintext) . "</p>";
        echo "<p><strong>Ciphertext:</strong> " . htmlspecialchars($ciphertext) . "</p>";
    }
    ?>

