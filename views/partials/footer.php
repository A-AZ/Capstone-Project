</div>
</div>
</div>
</div>



<?php if (isset($_SESSION['user'])) : ?>
  <footer class="bg-dark text-white ">
    <div class="container-fluid d-flex flex-column  align-items-center">
      <a href="mailto:pos_demo@example.com" class="mt-2">pos_demo@example.com</a>
      <a href="tel:+96223456789" class="mt-3">+96223 456 789</a>
      <p class="mt-3">&copy; Copyright <?= date('Y') ?>. All Rights Reserved.</p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

  <script src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/js/script.js"></script>
  </body>
<?php endif; ?>

</html>