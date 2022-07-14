import React, { useEffect } from "react";
import { useSnackbar } from "notistack";

/**
 * FormErrors component.
 *
 * @since 1.0.0
 */
export default function ErrorSnackbar({ errors }) {
  const { enqueueSnackbar } = useSnackbar();

  useEffect(() => {
    Object.keys(errors).map((key) => {
      enqueueSnackbar(errors[key], {
        variant: "error",
        anchorOrigin: { vertical: "bottom", horizontal: "right" },
      });
    });
  }, [errors]);

  return <></>;
}
