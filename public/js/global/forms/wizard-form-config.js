const WizardForm = (function () {
    let currentStep = 1; // Save step number, start with 1
    const steps = {}; // Save all steps config

    /**
     * Initializes the stepper with an array of step IDs.
     * Example: ['step_1', 'step_2', 'final_step']
     * Each step ID will be linked to its indicator and form wrapper.
     */
    function initStepper(stepIds = []) {
        // Clear any existing step configurations
        Object.keys(steps).forEach((key) => delete steps[key]);

        // Register each step with its indicator and content wrapper
        stepIds.forEach((stepId, index) => {
            const stepNumber = index + 1;
            steps[stepNumber] = {
                stepIndicator: `#${stepId}`,
                wrapperId: `#form_${stepId}_wrapper`,
                isFinal: stepId === "final_step",
            };
        });

        // Automatically go to the first step after initializing
        goToStep(1);
    }

    /**
     * Navigates to a specific step number.
     */
    function goToStep(stepNumber) {
        // Hide all step wrappers and deactivate step indicators
        Object.values(steps).forEach((step) => {
            $(step.wrapperId).addClass("hidden");
        });

        // Show and activate the target step
        const step = steps[stepNumber];
        if (step) {
            $(step.wrapperId).removeClass("hidden");
            $(step.stepIndicator).addClass("step-primary");
            currentStep = stepNumber;
        } else {
            console.warn(`Step ${stepNumber} not found`);
        }
    }

    /**
     * Moves to the next step if it exists.
     */
    function next() {
        if (steps[currentStep + 1]) {
            goToStep(currentStep + 1);
        }
    }

    /**
     * Moves to the previous step if it exists.
     */
    function prev() {
        if (steps[currentStep - 1]) {
            goToStep(currentStep - 1);
        }
    }

    /**
     * Resets the wizard back to the first step.
     */
    function reset() {
        goToStep(1);
    }

    /**
     * Checks if the current step is the final step.
     */
    function isFinal() {
        return steps[currentStep]?.isFinal || false;
    }

    /**
     * Clears input fields inside the specified step number.
     * Will clear input, textarea, and select elements.
     */
    function clearStep(stepNumber) {
        const step = steps[stepNumber];
        if (!step) {
            console.warn(`Step ${stepNumber} not found`);
            return;
        }

        const $wrapper = $(step.wrapperId);
        const $form = $wrapper.find("form");

        // If a <form> exists inside the wrapper, reset it
        if ($form.length) {
            $form[0].reset();
        }

        // Manually clear TomSelect and other custom elements
        $(step.wrapperId)
            .find("select")
            .each(function () {
                if (this.tomselect) {
                    this.tomselect.clear();
                } else {
                    $(this).val("");
                }
            });

        $(step.wrapperId)
            .find("input, textarea")
            .not('[type="button"], [type="submit"], [type="reset"]')
            .val("");

        console.info(`Step ${stepNumber} cleared`);
    }

    return {
        initStepper,
        goToStep,
        next,
        prev,
        reset,
        isFinalStep: isFinal,
        getCurrentStep: () => currentStep,
        clearStep,
    };
})();
