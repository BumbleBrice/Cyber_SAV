<section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Ajouter un problème</h1>

        <?php if ($success): ?>
            <div class="notification is-success">
                ✅ Problème ajouté avec succès.
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="notification is-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" novalidate>
            <div class="field">
                <label class="label" for="title">Titre du problème <span aria-hidden="true">*</span></label>
                <div class="control">
                    <input class="input" type="text" name="title" id="title" required>
                </div>
            </div>

            <div class="field">
                <label class="label" for="description">Description <span aria-hidden="true">*</span></label>
                <div class="control">
                    <textarea class="textarea" name="description" id="description" rows="4" required></textarea>
                </div>
            </div>

            <!-- Marque -->
            <div class="field">
                <label class="label" for="brand_id">Marque <span aria-hidden="true">*</span></label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="brand_id" id="brand_id">
                            <option value="">-- Sélectionner une marque --</option>
                            <?php foreach ($brands as $brand): ?>
                                <option value="<?= $brand['id'] ?>"><?= htmlspecialchars($brand['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <p class="help">Ou ajouter une nouvelle marque :</p>
                <input class="input" type="text" name="new_brand" placeholder="Nouvelle marque (facultatif)">
            </div>

            <!-- Type de composant -->
            <div class="field">
                <label class="label" for="component_id">Type de composant</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="component_id" id="component_id">
                            <option value="">-- Aucun --</option>
                            <?php foreach ($components as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['type']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <p class="help">Ou ajouter un nouveau type de composant :</p>
                <input class="input mt-2" type="text" name="new_component_type" placeholder="Nouveau type de composant (facultatif)">
            </div>

            <!-- Composant -->
            <div class="field">
                <label class="label" for="component_model_id">Modèle de composant</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="component_model_id" id="component_model_id">
                            <option value="">-- Aucun --</option>
                            <?php foreach ($componentModels as $model): ?>
                                <option value="<?= $model['id'] ?>">
                                    <?= htmlspecialchars("{$model['brand']} - {$model['name']}") ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <input class="input mt-2" type="text" name="new_component_model" placeholder="Nouveau modèle de composant (facultatif)">
            </div>

            <!-- Périphérique -->
            <div class="field">
                <label class="label" for="peripheral_id">Périphérique</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="peripheral_id" id="peripheral_id">
                            <option value="">-- Aucun --</option>
                            <?php foreach ($peripherals as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <input class="input mt-2" type="text" name="new_peripheral" placeholder="Nouveau périphérique (facultatif)">
            </div>

            <!-- Setup -->
            <div class="field">
                <label class="label" for="setup_id">Modèle de PC portable</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="setup_id" id="setup_id">
                            <option value="">-- Aucun --</option>
                            <?php foreach ($setups as $s): ?>
                                <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['model']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <input class="input mt-2" type="text" name="new_setup" placeholder="Nouveau modèle de setup (facultatif)">
            </div>

            <div class="field is-grouped is-grouped-centered mt-5">
                <div class="control">
                    <button type="submit" class="button is-link">Ajouter le problème</button>
                </div>
            </div>
        </form>
    </div>
</section>
