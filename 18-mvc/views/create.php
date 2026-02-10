<form method="POST"
      action="index.php?action=create"
      class="space-y-4">

  <div>
    <label class="label">
      <span class="label-text text-white">Trainer</span>
    </label>

    <select
      name="trainer_id"
      class="select select-bordered w-full bg-gray-700 text-white"
      required
    >
      <option disabled selected class="bg-gray-800 text-gray-400">
        Select Trainer
      </option>

      <?php foreach ($data as $trainer): ?>
        <option value="<?= $trainer['id'] ?>" class="bg-gray-800 text-white">
          <?= htmlspecialchars($trainer['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div>
    <label class="label">
      <span class="label-text text-white">Name</span>
    </label>
    <input
      type="text"
      name="name"
      class="input input-bordered w-full bg-gray-700 text-white"
      required>
  </div>

  <div>
    <label class="label">
      <span class="label-text text-white">Type</span>
    </label>
    <input
      type="text"
      name="type"
      class="input input-bordered w-full bg-gray-700 text-white"
      required>
  </div>

  <button class="btn btn-success w-full">
    Save Pokémon
  </button>
</form>
