/** @jsxImportSource @emotion/react */
import React from "react";
import ButtonDotted from "@/Components/Buttons/ButtonDotted";
import Panel from "@/Components/Panel";
import { Typography, useTheme } from "@mui/material";
import { grey } from "@mui/material/colors";
import { css } from "@emotion/react";
import { Inertia } from "@inertiajs/inertia";
import { strings } from "@/strings";

/**
 * NoTadasFound component.
 *
 * @since 1.2.0
 */
export default function NoTadasFound() {
  const theme = useTheme();

  const addTadaList = () => {
    Inertia.post(
      route("tadaLists.store"),
      {
        name: strings.defaultTadaListTitle,
      },
      { replace: true }
    );
  };

  return (
    <Panel>
      <div
        css={css`
          display: flex;
          height: 800px;
          max-height: 100%;
          max-width: 1200px;
          margin: 0 auto;
          flex-direction: column;
          align-items: center;
        `}
      >
        <ButtonDotted
          css={css`
            height: 100%;
            width: 100%;
            position: relative;
            top: -14px;
          `}
          onClick={addTadaList}
        >
          <div
            css={css`
              display: flex;
              flex-direction: column;
              width: 100%;
            `}
          >
            <Typography
              css={css`
                font-size: 30px;
                ${theme.breakpoints.up("lg")} {
                  font-size: 40px;
                  color: ${theme.palette.mode === "dark"
                    ? grey[300]
                    : theme.palette.text.primary};
                }
              `}
              variant="h3"
              component="p"
            >
              Welcome! 👋
              <br />
              Click to get started! 🎉
            </Typography>
          </div>
        </ButtonDotted>
      </div>
    </Panel>
  );
}
