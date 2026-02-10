<form
  method="POST"
  action="index.php?action=edit&id=<?= $data['id'] ?>"
  class="space-y-4"
>

  <div>
    <label class="label">
      <span class="label-text text-white">Name</span>
    </label>
    <input
      type="text"
      name="name"
      value="<?= htmlspecialchars($data['name']) ?>"
      class="input input-bordered w-full bg-gray-700 text-white placeholder-gray-400"
      required
    >
  </div>

  <div>
    <label class="label">
      <span class="label-text text-white">Type</span>
    </label>
    <input
      type="text"
      name="type"
      value="<?= htmlspecialchars($data['type']) ?>"
      class="input input-bordered w-full bg-gray-700 text-white placeholder-gray-400"
      required
    >
  </div>

  <button class="btn btn-warning w-full">
    Update Pokémon
  </button>

</form>
